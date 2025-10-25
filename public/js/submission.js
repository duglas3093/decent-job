const BASE_URL_ROOT = document.getElementById('BASE_URL_ROOT').value;     
const BENEFICIARY_ID = document.getElementById('beneficiaryId').value;
const QUESTIONNAIRE_ID = document.getElementById('questionnaireId').value;

document.getElementById('submissionForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('submitSubmissionBtn');
    btn.disabled = true;
    btn.textContent = 'Enviando...';
    
    const formData = new FormData(this);
    const submissionData = {
        beneficiary_id: BENEFICIARY_ID,
        questionnaire_id: QUESTIONNAIRE_ID,
        responses: []
    };

    document.querySelectorAll('.question-block').forEach(block => {
        const qId = block.dataset.questionId;
        const qType = block.dataset.type;
        let value = null;
        let optionIds = [];

        if (qType === 'SINGLE_SELECT') {
            const selected = block.querySelector(`input[name="q_${qId}"]:checked`);
            if (selected) {
                optionIds.push(selected.value);
            }
        } else if (qType === 'MULTIPLE_CHOICE') {
            block.querySelectorAll(`input[name="q_${qId}[]"]:checked`).forEach(checkbox => {
                optionIds.push(checkbox.value);
            });
            value = optionIds; 
            optionIds = []; 
        } else {
            value = block.querySelector(`input[name="q_${qId}"]`).value;
        }
        
        if (optionIds.length > 0) {
            submissionData.responses.push({
                question_id: qId,
                option_ids: optionIds
            });
        } 
        
        else if (value !== null && value !== undefined && value !== "") {
            submissionData.responses.push({
                question_id: qId,
                value: value
            });
        }
    });

    try {
        const response = await fetch( BASE_URL_ROOT + '/admin/store_submission', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(submissionData)
        });
        
        const result = await response.json();
        const statusMessage = document.getElementById('statusMessage');

        if (response.ok) {
            statusMessage.className = 'p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg';
            statusMessage.textContent = result.message || '¡Seguimiento guardado con éxito!';
            setTimeout(() => {
                window.location.href = `<?= base_url('admin/kardex/viewKardex/') ?>/${BENEFICIARY_ID}`;
            }, 1500);

        } else {
            statusMessage.className = 'p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg';
            statusMessage.textContent = 'Error al guardar: ' + (result.error || 'Verifique la consola para más detalles.');
        }

    } catch (error) {
        statusMessage.className = 'p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg';
        statusMessage.textContent = 'Error de conexión con el servidor.';
        console.error('Fetch Error:', error);
    } finally {
        btn.disabled = false;
        btn.textContent = 'Enviar Respuestas';
        statusMessage.classList.remove('hidden');
    }
});