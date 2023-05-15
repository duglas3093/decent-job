<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Contact;

class ContactController extends BaseController
{
    public function contactBeneficiary()
    {
        $beneficairy_id = $this->request->getPost('beneficiary');
        $contactModel = model('ContactModel');
        $contacts = $contactModel->where('beneficiary_id', $beneficairy_id)->findAll();
        echo json_encode($contacts);
    }

    public function store(){
        $beneficiary_id = $this->request->getPost('beneficiary');
        $contact_name = $this->request->getPost('name');
        $contact_phone = $this->request->getPost('phone');
        $contactModel = model('ContactModel');
        $formData = [
            'beneficiary_id'    => $beneficiary_id,
            'contact_name'      => $contact_name,
            'contact_phone'     => $contact_phone,
        ];
        $contact = new Contact($formData);
        $contactModel->save($contact);
        echo json_encode("ok");
    }
}
