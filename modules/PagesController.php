<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() 
	{
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
	
	public function notAuthorized() 
	{
		$this->layout = false;
	}
	
	public function logout() 
	{
		$this->layout = false;
	}
	
	public function test() 
	{
		$this->layout = false;
	}
	
	public function search() 
	{
		$this->layout = false;
		$this->autoRender = false;
		
		// The request is a JSON request.
		// We must read the input.
		// $_POST or $_GET will not work!

		$data = file_get_contents("php://input");

		$objData = json_decode($data);

		// perform query or whatever you wish, sample:

		/*
		$query = 'SELECT * FROM
		tbl_content
		WHERE
		title="'. $objData->data .'"';
		*/

		// Static array for this demo
		$values = array('php', 'web', 'angularjs', 'js');

		// Check if the keywords are in our array
		if(in_array($objData->data, $values)) {
			echo 'I have found what you\'re looking for!';
		}
		else {
			echo 'Sorry, no match!';
		}
	}
	
	public function test2() 
	{
		$this->layout = false;
	}
	
	public function search2() 
	{
		$this->layout = false;
		$this->autoRender = false;
		
		$data = json_decode(file_get_contents("php://input"));
		$usrname = mysql_real_escape_string($data->uname);
		$upswd = mysql_real_escape_string($data->pswd);
		$uemail = mysql_real_escape_string($data->email);

		/*$con = mysql_connect('localhost', 'root', '');
		mysql_select_db('test', $con);

		$qry_em = 'select count(*) as cnt from users where email ="' . $uemail . '"';
		$qry_res = mysql_query($qry_em);
		$res = mysql_fetch_assoc($qry_res);

		if ($res['cnt'] == 0) {
			$qry = 'INSERT INTO users (name,pass,email) values ("' . $usrname . '","' . $upswd . '","' . $uemail . '")';
			$qry_res = mysql_query($qry);
			if ($qry_res) {
				$arr = array('msg' => "User Created Successfully!!!", 'error' => '');
				$jsn = json_encode($arr);
				print_r($jsn);
			} else {
				$arr = array('msg' => "", 'error' => 'Error In inserting record');
				$jsn = json_encode($arr);
				print_r($jsn);
			}
		} else {
			$arr = array('msg' => "", 'error' => 'User Already exists with same email');
			$jsn = json_encode($arr);
			print_r($jsn);
		}*/
		
		$arr = array('msg' => "", 'error' => $usrname);
		$jsn = json_encode($arr);
		print_r($jsn);
	}
	
	public function test3() 
	{
		$this->layout = false;
		
		$this->loadModel("Channel");
		$this->Channel->recursive = -1;
		
		$channelOptions = $this->Channel->find('all', array(
															'fields' => array('id', 'name'),
															'conditions' => array('status' => 1),
															'order' => array('name')
														));
		
		foreach ($channelOptions as $key => $val)
		{
			$channelArray[$key]['id'] = $val['Channel']['id'];
			$channelArray[$key]['name'] = $val['Channel']['name'];					
		}
		$channelOptions = json_encode($channelArray);
		//echo 'channelOptions=<pre>';print_r($channelOptions );
		$this->set(compact('channelOptions'));
	}
	
	public function test4() 
	{
		$this->layout = false;	
	}
	
	public function upload() 
	{
		$this->layout = false;
		$this->autoRender = false;
		
		if(isset($_FILES['file'])){    
			$errors= array();        
			$file_name = $_FILES['file']['name'];
			$file_size =$_FILES['file']['size'];
			$file_tmp =$_FILES['file']['tmp_name'];
			$file_type=$_FILES['file']['type'];   
			$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$extensions = array("jpeg","jpg","png");        
			if(in_array($file_ext,$extensions )=== false){
				 $errors[]="image extension not allowed, please choose a JPEG or PNG file.";
			}
			if($file_size > 2097152){
				$errors[]='File size cannot exceed 2 MB';
			}               
			if(empty($errors)==true){
				move_uploaded_file($file_tmp,WWW_ROOT."images/".$file_name);
				echo " uploaded file: " . "images/" . $file_name;
			}else{
				print_r($errors);
			}
		}
		else{
			$errors= array();
			$errors[]="No image found";
			print_r($errors);
		}
	}
	
}