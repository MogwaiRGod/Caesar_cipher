<?php
namespace Controllers;

use Classes\Cesar;
use core\AbstractController;

/**
 * Documentation
 * 
 * @method public static null|Exception encode(): Encrypts the user input and send the corresponding json
 * @method private static string|Exception manageForm(): Manages the data from the form and encodes the text
 */
class CesarController extends AbstractController {

    /**
     * Encrypts the user POST input and send the corresponding json
     * 
     * @return null|Exception
     */
    public function encode(): null|Exception
    {        
        try {
            $cesarUser = $this->manageForm();

            $codedMessage = [
                'code' => $cesarUser->getCodedString(),
                'offset' => $cesarUser->getOriginalOffset()
            ];

            header('Content-Type: application/json');
            echo json_encode($codedMessage);

        } catch (Exception $e) {
            return $e;
        } // try catch
        
        // empties the $_POST array
        $_POST = array();
        
        return null;
    } // index

    /**
     * Retrieves the POST data and encrypts the input text with the optional input offset
     * 
     * @return Cesar|Exception Returns the final Cesar object
     */
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