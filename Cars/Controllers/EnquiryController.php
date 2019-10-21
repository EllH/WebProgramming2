<?php
namespace cars\Controllers;
class EnquiryController {
    private $enquiriesTable;
    private $get;
    private $post;

    public function __construct($enquiriesTable, array $get, array $post) {
        $this->enquiriesTable = $enquiriesTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function viewEnquiries() {
        $enquiries = $this->enquiriesTable->findAll();

        return [
            'template' => 'enquiries.html.php',
            'variables' => ['enquiries' => $enquiries],
            'title' => "Claires's Cars - Admin"
        ];
    }

    public function contact($errors = []) {
        return [
            'template' => 'contact.html.php',
            'variables' => ['main' => 'home',
                            'errors' => $errors],
            'title' => "Claires's Cars - Contact"
        ];
    }

    public function validateEnquiry($enquiry) {
        $errors = [];

        if ($enquiry['name'] == '') {
            $errors[] = 'You must enter a name';
        }
        if ($enquiry['email'] == '' && $enquiry['telephone_number'] == '') {
            $errors[] = 'You must enter a either an email or telephone number';
        }
        if ($enquiry['content'] == '') {
            $errors[] = 'You must enter an enquiry';
        }
        return $errors;
    }

    public function saveEnquiry() {
        $errors = $this->validateEnquiry($this->post['enquiry']);
        if (count($errors) == 0) {
            $this->enquiriesTable->save($this->post['enquiry']);
            header('location: /');
        } else {
            return $this->contact($errors);
        }
    }

    public function completeEnquiry() {
        $this->enquiriesTable->update($this->post['enquiry']);
        header('location: /admin/enquiries');
    }

    public function viewCompletedEnquiries() {
        $enquiries = $this->enquiriesTable->findAll();

        return [
            'template' => 'completedenquiries.html.php',
            'variables' => ['enquiries' => $enquiries],
            'title' => "Claires's Cars - Admin"
        ];
    }
    public function restoreEnquiry() {
        $this->enquiriesTable->update($this->post['enquiry']);
        header('location: /admin/completedenquiries');
    }

}
