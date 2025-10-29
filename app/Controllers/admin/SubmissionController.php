<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class SubmissionController extends BaseController
{
    protected $submissionModel;
    protected $questionModel;
    protected $responseOptionModel;
    protected $userResponseModel;
    protected $db;

    public function __construct()
    {
        $this->submissionModel = model('SubmissionModel');
        $this->questionModel = model('QuestionModel');
        $this->responseOptionModel = model('ResponseOptionModel');
        $this->userResponseModel = model('UserResponseModel');
        $this->db = \Config\Database::connect();
    }
    private function getSubmissionDetails(int $submissionId): ?array
    {
        $submissionBase = $this->submissionModel
            ->join('questionnaires qn', 'qn.questionnaire_id = submissions.questionnaire_id') 
            ->select('submissions.*, qn.questionnaire_title, qn.questionnaire_description')
            ->find($submissionId);

        if (!$submissionBase) {
            log_message('error', "Submission ID not found: $submissionId"); 
            return null;
        }

        $questionnaireId = $submissionBase['questionnaire_id'];

        $questionsData = $this->questionModel
            ->where('questionnaire_id', $questionnaireId)
            ->orderBy('display_order', 'ASC')
            ->findAll();

        if (empty($questionsData)) {
            log_message('error', "No questions found for Questionnaire ID: $questionnaireId"); 
            $finalSubmission = [
                'id'            => $submissionBase['id'] ?? $submissionBase['submission_id'], 
                'user_id'       => $submissionBase['user_id'],
                'questionnaire_id'=> $submissionBase['questionnaire_id'],
                'submitted_at'  => $submissionBase['submitted_at'],
                'status'        => $submissionBase['status'],
                'title'         => $submissionBase['questionnaire_title'],
                'description'   => $submissionBase['questionnaire_description'],
                'questions'     => []
            ];
            return $finalSubmission;
        }

        
        $finalQuestions = [];
        $allQuestionIds = array_column($questionsData, 'question_id');

        
        $allOptions = $this->responseOptionModel
            ->whereIn('question_id', $allQuestionIds)
            ->findAll();
        $optionsByQuestion = [];
        
        foreach ($allOptions as $opt) {
            
            $optionsByQuestion[(int)$opt['question_id']][] = $opt;
        }

        $allUserResponses = $this->userResponseModel
            ->where('submission_id', $submissionId)
            ->findAll();

        $responsesByQuestion = [];
        foreach ($allUserResponses as $resp) {
            $qId = (int)$resp['question_id']; 
            if (!isset($responsesByQuestion[$qId])) {
                $responsesByQuestion[$qId] = ['selected_options' => [], 'text_value' => null];
            }
            if ($resp['option_id'] !== null) {
                
                $responsesByQuestion[$qId]['selected_options'][] = (int)$resp['option_id'];
            }
            if ($resp['response_value'] !== null) {
                $responsesByQuestion[$qId]['text_value'] = $resp['response_value'];
            }
        }

        foreach ($questionsData as $q) {
            $qId = (int)$q['question_id']; 
            $questionOptions = $optionsByQuestion[$qId] ?? [];
            $userResp = $responsesByQuestion[$qId] ?? ['selected_options' => [], 'text_value' => null];
            $assembledOptions = [];

            print_r($userResp['selected_options'], true);

            foreach ($questionOptions as $opt) {
                
                $optionIdInt = (int)$opt['response_option_id'];

                
                log_message('debug', "  -> Checking Option ID: $optionIdInt");
                
                $isInArray = in_array($optionIdInt, $userResp['selected_options'], false); 
                log_message('debug', "     -> in_array Result for Option $optionIdInt: " . ($isInArray ? 'TRUE' : 'FALSE'));
                

                $assembledOptions[] = [
                    'id' => (string)$optionIdInt,
                    'text' => $opt['option_text'],
                    'value' => $opt['option_value'],
                    'is_selected' => $isInArray 
                ];
            }

            $finalQuestions[] = [
                'id' => $qId,
                'text' => $q['question_text'],
                'type' => $q['response_type'],
                'order' => $q['display_order'],
                'options' => $assembledOptions,
                'user_responses' => [
                    'text_value' => $userResp['text_value'],
                ]
            ];
        }

        
        $finalSubmission = [
            'id'            => $submissionBase['id'] ?? $submissionBase['submission_id'], 
            'user_id'       => $submissionBase['user_id'],
            'questionnaire_id'=> $submissionBase['questionnaire_id'],
            'submitted_at'  => $submissionBase['submitted_at'],
            'status'        => $submissionBase['status'],
            'title'         => $submissionBase['questionnaire_title'],
            'description'   => $submissionBase['questionnaire_description'],
            'questions'     => $finalQuestions
        ];

        return $finalSubmission;
    }

    public function edit(int $submissionId)
    {
        $submissionDetails = $this->getSubmissionDetails($submissionId);

        if (!$submissionDetails) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data['submission'] = $submissionDetails;
        $data['is_read_only'] = false; 
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();

        
        return view('admin/submission/edit_view', $data); 
    }

    public function view(int $submissionId)
    {
        $submissionDetails = $this->getSubmissionDetails($submissionId);

        if (!$submissionDetails) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data['submission'] = $submissionDetails;
        $data['is_read_only'] = true; 
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $data['areas'] = $areaModel->where('status_id', 1)->findAll();

        return view('admin/submission/edit_view', $data); 
    }

    public function update()
    {
        // 1. Obtener y parsear el JSON
        $data = $this->request->getJSON(true);

        $submissionId = $data['submission_id'] ?? null;
        $updatedResponses = $data['responses'] ?? [];

        // Validación básica
        if (empty($submissionId) || !is_numeric($submissionId)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Se requiere un ID de Submission válido.']);
        }
        // Nota: Permitimos $updatedResponses vacío si el usuario borró todas las respuestas.

        // --- INICIO DE LA TRANSACCIÓN ---
        $this->db->transBegin();

        try {
            // Asegúrate de usar los modelos correctos
            $userResponseModel = model('UserResponseModel'); 
            $submissionModel = model('SubmissionModel'); // Para verificar si existe

            // Opcional: Verificar si la submission existe antes de borrar
            $submissionExists = $submissionModel->find($submissionId);
            if (!$submissionExists) {
                 $this->db->transRollback(); // Deshacer si no existe
                 return $this->response->setStatusCode(404)->setJSON(['error' => 'Submission no encontrada.']);
            }

            // 2. BORRAR todas las respuestas existentes para esta Submission
            $userResponseModel->where('submission_id', $submissionId)->delete();

            // 3. Procesar y RE-INSERTAR las nuevas respuestas (similar a store_submission)
            $batchInsertData = [];
            foreach ($updatedResponses as $response) {
                $questionId = $response['question_id'];

                // a) Manejo de Selección Múltiple/Única
                if (isset($response['option_ids']) && is_array($response['option_ids'])) {
                    foreach ($response['option_ids'] as $optionId) {
                        if (!empty($optionId)) {
                            $batchInsertData[] = [
                                'submission_id' => $submissionId,
                                'question_id'   => $questionId,
                                'option_id'     => (int)$optionId,
                                'response_value'=> null,
                            ];
                        }
                    }
                } 
                // b) Manejo de Texto Libre / Numérico
                elseif (isset($response['value'])) {
                    $finalValue = is_array($response['value']) ? json_encode($response['value']) : (string)$response['value'];
                    // Solo insertar si hay un valor real
                    if ($finalValue !== '') { 
                        $batchInsertData[] = [
                            'submission_id' => $submissionId,
                            'question_id'   => $questionId,
                            'option_id'     => null,
                            'response_value'=> $finalValue,
                        ];
                    }
                }
            } // Fin foreach

            // 4. Inserción Masiva (si hay nuevas respuestas)
            if (!empty($batchInsertData)) {
                $userResponseModel->insertBatch($batchInsertData);
            }

            // 5. Finalizar la Transacción
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                log_message('error', 'Submission update transaction failed for Submission ID: ' . $submissionId);
                return $this->response->setStatusCode(500)->setJSON(['error' => 'La actualización falló. Rollback ejecutado.']);
            } else {
                $this->db->transCommit();
                // Opcional: Actualizar el 'updated_at' en la tabla submissions si existe
                // $submissionModel->update($submissionId, ['updated_at' => date('Y-m-d H:i:s')]);

                return $this->response->setJSON([
                    'status' => 'success', 
                    'message' => 'Respuestas actualizadas con éxito.', 
                    'id' => $submissionId
                ]);
            }

        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Submission Update Exception: ' . $e->getMessage() . ' | Data: ' . print_r($data, true)); 
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Error del servidor: ' . $e->getMessage()]);
        }
    }
}
