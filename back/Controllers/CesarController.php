<?php
namespace Controllers;

use Classes\Cesar;
use core\AbstractController;

/**
 * Documentation
 * 
 * @method public static null index()
 * @method private static string|Exception manageForm(): Manages the data from the form and encodes the text
 */
class CesarController extends AbstractController {

    public function encode()
    {        
        try {
            $cesarUser = $this->manageForm();

            $codedMessage = [
                'code' => $cesarUser->getCodedString(),
                'offset' => $cesarUser->getOriginalOffset()
            ];

            header('Content-Type: application/json');
            echo json_encode($codedMessage);
            return;
            
        } catch (Exception $e) {
            return $e;
        } // try catch
        
        // empties the $_POST array
        $_POST = array();
        
    } // index

    private function manageForm(): Cesar|Exception
    {
        try {
            // checks if the input is not null
            if (!$_POST['ipt-offset'] == "") {
                // sets the input offset
                (int) $offset = $_POST['ipt-offset'];
            } else {
                $offset = null;
            } // endif

            // gets the data
            $cesar = new Cesar($_POST['ipt-txt'], $offset);

            // return the coded text input
            return $cesar;

        } catch (Exception $e) {
            echo $e;
        } // try catch
    } // manageForm

} // CesarController