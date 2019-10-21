<?php
namespace cars;
class Routes implements \CSY2028\Routes {
 public function getRoutes()
 {
     require '../database.php';
     $manufacturersTable = new \CSY2028\DatabaseTable($pdo, 'manufacturers', 'id', 'stdclass', []);
     $staffTable = new \CSY2028\DatabaseTable($pdo, 'staff', 'id', 'stdclass', []);
     $carsTable = new \CSY2028\DatabaseTable($pdo, 'cars', 'id', '\Cars\Entity\Car', [$manufacturersTable, $staffTable]);
     $articleTable = new \CSY2028\DatabaseTable($pdo, 'articles', 'id', '\Cars\Entity\Article', [$staffTable]);
     $enquiriesTable = new \CSY2028\DatabaseTable($pdo, 'enquiries', 'id', '\Cars\Entity\Enquiry', [$staffTable]);
     $carController = new \Cars\Controllers\CarController($carsTable, $manufacturersTable, $_GET, $_POST);
     $adminController = new \Cars\Controllers\AdminController($staffTable, $manufacturersTable, $_GET, $_POST);
     $articleController = new \Cars\Controllers\ArticleController($articleTable, $_GET, $_POST);
     $enquiryController = new \Cars\Controllers\EnquiryController($enquiriesTable, $_GET, $_POST);
     $routes = [
         '' => [
             'GET' => [
                 'controller' => $articleController,
                 'function' => 'home'
             ]
         ],
         'cars' => [
             'GET' => [
                 'controller' => $carController,
                 'function' => 'cars'
             ]
         ],
         'about' => [
             'GET' => [
                 'controller' => $carController,
                 'function' => 'about'
             ]
         ],
         'contact' => [
             'GET' => [
                 'controller' => $enquiryController,
                 'function' => 'contact'
             ],
             'POST' => [
                 'controller' => $enquiryController,
                 'function' => 'saveEnquiry'
             ]
         ],
         'careers' => [
             'GET' => [
                 'controller' => $carController,
                 'function' => 'careers'
             ]
         ],

         'admin' => [
             'GET' => [
                 'controller' => $adminController,
                 'function' => 'loginForm'
             ],
             'POST' => [
                 'controller' => $adminController,
                 'function' => 'loginSubmit'
             ]
         ],
         'admin/home' => [
             'GET' => [
                'controller' => $adminController,
                'function' => 'loggedIn'
            ],
             'login' => true
         ],
         'admin/logout' => [
             'GET' => [
                 'controller' => $adminController,
                 'function' => 'logout'
             ],
             'login' => true
         ],
         'logout' => [
             'GET' => [
                 'controller' => $adminController,
                 'function' => 'logout'
             ],
             'login' => true
         ],
         'admin/manufacturers' => [
             'GET' => [
                 'controller' => $adminController,
                 'function' => 'manufacturers'
             ],
             'login' => true
         ],
         'admin/editmanufacturer' => [
             'GET' => [
                 'controller' => $adminController,
                 'function' => 'addManufacturersForm'
             ],
             'login' => true,
             'POST' => [
                 'controller' => $adminController,
                 'function' => 'submitManufacturers'
             ],
             'login' => true
         ],
         'admin/deletemanufacturer' => [
             'POST' => [
                 'controller' => $adminController,
                 'function' => 'deleteManufacturer'
             ],
             'login' => true
        ],
         'admin/cars' => [
             'GET' => [
                 'controller' => $carController,
                 'function' => 'viewCars'
             ],
             'login' => true,
         ],
         'admin/editcar' => [
             'GET' => [
                 'controller' => $carController,
                 'function' => 'editCar'
             ],
             'login' => true,
             'POST' => [
                 'controller' => $carController,
                 'function' => 'saveCar'
             ],
             'login' => true
         ],
         'admin/deletecar' => [
             'POST' => [
                 'controller' => $carController,
                 'function' => 'deleteCar'
             ],
             'login' => true
         ],
         'admin/archivecar'  => [
             'POST' => [
                 'controller' => $carController,
                 'function' => 'archiveCar'
             ],
             'login' => true
         ],
         'admin/archivedcars' => [
             'GET' => [
                 'controller' => $carController,
                 'function' => 'archivedCars'
             ],
             'login' => true
         ],
         'admin/restorecar'  => [
             'POST' => [
                 'controller' => $carController,
                 'function' => 'restoreCar'
             ],
             'login' => true
         ],
         'admin/staff' => [
             'GET' => [
                 'controller' => $adminController,
                 'function' => 'viewStaff'
             ],
             'admin' => true
         ],
         'admin/editstaff' => [
             'GET' => [
                 'controller' => $adminController,
                 'function' => 'editStaff'
             ],
             'admin' => true,
             'POST' => [
                 'controller' => $adminController,
                 'function' => 'saveStaff'
             ],
             'admin' => true
         ],
         'admin/deletestaff' => [
             'POST' => [
                 'controller' => $adminController,
                 'function' => 'deleteStaff'
             ],
             'admin' => true
         ],
         'admin/changepassword' => [
             'GET' => [
                 'controller' => $adminController,
                 'function' => 'displayPasswordEditForm'
             ],
             'admin' => true,
             'POST' => [
                 'controller' => $adminController,
                 'function' => 'displayPasswordEditForm'
             ],
             'admin' => true,
         ],
         'admin/changePassword' => [
             'GET' => [
                 'controller' => $adminController,
                 'function' => 'displayPasswordEditForm'
             ],
             'admin' => true,
             'POST' => [
                 'controller' => $adminController,
                 'function' => 'saveStaffPassword'
             ],
             'admin' => true,
         ],
         'admin/articles' => [
             'GET' => [
                 'controller' => $articleController,
                 'function' => 'viewArticles'
             ],
             'login' => true,
         ],
         'admin/editarticle' => [
             'GET' => [
                 'controller' => $articleController,
                 'function' => 'editArticle'
             ],
             'login' => true,
             'POST' => [
                 'controller' => $articleController,
                 'function' => 'saveArticle'
             ],
             'login' => true
         ],
         'admin/deletearticle' => [
             'POST' => [
                 'controller' => $articleController,
                 'function' => 'deleteArticle'
             ],
             'login' => true
         ],
         'admin/enquiries' => [
             'GET' => [
                 'controller' => $enquiryController,
                 'function' => 'viewEnquiries'
             ],
             'login' => true,
         ],
         'admin/completedenquiry' => [
             'POST' => [
                 'controller' => $enquiryController,
                 'function' => 'completeEnquiry'
             ],
             'login' => true
         ],
         'admin/completedenquiries' => [
             'GET' => [
                 'controller' => $enquiryController,
                 'function' => 'viewCompletedEnquiries'
             ],
             'login' => true,
             'POST' => [
                 'controller' => $enquiryController,
                 'function' => 'restoreEnquiry'
             ],
             'login' => true
         ],
     ];
    return $routes;
 }
    public function checkLogin() {
    if (!isset($_SESSION['loggedin'])) {
        header('location: /admin');
    }
}

    public function checkAdmin() {
        if ($_SESSION['usertype'] !== 'ADMIN') {
            header('location: /admin/home');
        }
    }

}
