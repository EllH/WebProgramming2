<?php
namespace cars\Controllers;
class CarController {
	private $carsTable;
    private $manufacturersTable;
    private $get;
    private $post;

	public function __construct($carsTable, $manufacturersTable, array $get, array $post) {
		$this->carsTable = $carsTable;
		$this->manufacturersTable = $manufacturersTable;
        $this->get = $get;
        $this->post = $post;
	}

	public function home() {
        return [
            'template' => 'home.html.php',
            'variables' => ['main' => 'home'],
            'title' => "Claires's Cars - Home"
        ];
	}

	public function cars() {
        if (isset($this->get['id'])){
            $cars = $this->carsTable->find('manufacturerId', $this->get['id']);
            $manufacturer = $this->manufacturersTable->find('id', $this->get['id'])[0];
            $pageHeading = $manufacturer->name;

        } else {
            $cars = $this->carsTable->findAll();
            $pageHeading = 'Our ';
        }
        $manufacturers = $this->manufacturersTable->findAll();
        return [
            'template' => 'cars.html.php',
            'variables' => ['cars' => $cars,
                            'pageHeading' => $pageHeading,
                            'manufacturers' => $manufacturers],
            'title' => "Claires's Cars -  " . $pageHeading
        ];
    }

    public function about() {
        return [
            'template' => 'about.html.php',
            'variables' => ['main' => 'home'],
            'title' => "Claires's Cars - About"
        ];
    }

    public function careers() {
	    return [
            'template' => 'careers.html.php',
            'variables' => ['main' => 'home'],
            'title' => "Claire’s Careers"
        ];
    }
    public function viewCars() {
	    $cars = $this->carsTable->findAll();

        return [
            'template' => 'adminCars.html.php',
            'variables' => ['cars' => $cars],
            'title' => "Claires's Cars - Our Cars"
        ];
    }

    public function editCar($errors = []) {
        if (isset($this->get['id'])){
            $car = $this->carsTable->find('id', $this->get['id'])[0];
        } else {
            $car = false;
        }
        $manufacturers = $this->manufacturersTable->findAll();
        return [
            'template' => 'editcar.html.php',
            'variables' => ['car' => $car,
                'manufacturers' => $manufacturers,
                'errors' => $errors],
            'title' => "Claires's Cars - Our Cars"
        ];
    }

    public function validateCar($car) {
        $errors = [];
        if ($car['name'] == '') {
            $errors[] = 'You must enter a name';
        }
        if ($car['price'] == '') {
            $errors[] = 'You must enter a price';
        }
        if (!is_numeric($car['price'])) {
            $errors[] = 'You must enter a number';
        }
        if ($car['mileage'] == '') {
            $errors[] = 'You must enter a mileage';
        }
        if (!is_numeric($car['mileage'])) {
            $errors[] = 'You must enter a number';
        }
        if ($car['engine_type'] == '') {
            $errors[] = 'You must enter a engine type';
        }
        if ($car['description'] == '') {
            $errors[] = 'You must enter a description';
        }
        return $errors;
    }

    public function saveCar() {
	    $errors = $this->validateCar($this->post['car']);
        if (count($errors) == 0) {
            $this->carsTable->save($this->post['car']);
            $folderName = $this->carsTable->getLastInsertId();
            $folder = '/srv/http/default/public/images/cars/' . $this->carsTable->getLastInsertId() . '/';
            extract($this->post);
            $error = array();
            $extension = array("jpg");
            $i = 1;
                if (!is_dir($folder)) {
                    mkdir($folder, 0777, true);
                }
                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    $file_name = $_FILES["images"]["name"][$key];
                    $file_tmp = $_FILES["images"]["tmp_name"][$key];
                    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                    if (in_array($ext, $extension)) {
                        if (!file_exists("/srv/http/default/public/images/cars/" . $folderName . "/" . $file_name)) {
                            $file_name = $i . '.' . $ext;
                            move_uploaded_file($file_tmp = $_FILES["images"]["tmp_name"][$key], "/srv/http/default/public/images/cars/" . $folderName . "/" . $file_name);
                            $i++;
                        } else {
                            $filename = basename($file_name, $ext);
                            $newFileName = $filename . time() . "." . $ext;
                            move_uploaded_file($file_tmp = $_FILES['images']['tmp_name'][$key], "/srv/http/default/public/images/cars/" . $folderName . "/" . $newFileName);
                        }
                    } else {
                        array_push($error, "$file_name, ");
                    }
                }
                header('location: /admin/cars');
            } else {
            echo 'Errors';
                return $this->editCar($errors);
            }
	}

    public function deleteDir($dirPath)
    {
        if (!is_dir($dirPath)) {
            if (file_exists($dirPath) !== false) {
                unlink($dirPath);
            }
            return;
        }

        if ($dirPath[strlen($dirPath) - 1] != '/') {
            $dirPath .= '/';
        }

        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    public function deleteCar() {
	    // Deletes Car
        $this->carsTable->delete($this->post['id']);
        $dir =  '/srv/http/default/public/images/cars/' . $this->post['id'];
        // Deletes Images
        $this->deleteDir($dir);

        header('location: /admin/cars');
    }

    public function archiveCar() {
	    $this->carsTable->update($this->post['car']);
        echo 'Archived';
        header('location: /admin/cars');
    }

    public function archivedCars() {
        $cars = $this->carsTable->findAll();
        return [
            'template' => 'archivedCars.html.php',
            'variables' => ['cars' => $cars],
            'title' => "Claires's Cars - Archived Cars"
        ];
    }

    public function restoreCar() {
        $this->carsTable->update($this->post['car']);
        echo 'Restored';
        header('location: /admin/archivedcars');
    }


}
