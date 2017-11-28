<?php

/**
* Class name: Validator
* Description: Class for form validation
* Author: Ivan Gajic
* Date: 16.08.2016

/*

Use example

<?php

include 'class.validator.php';



$validator = new Validator();

if($_POST){
	$validator->addField('name');
	$validator->addField('email');

	$validator->addRule('name', array('empty'));
	$validator->addRule('name', array('min-length', 2));


	$validator->addRule('email', array('empty'));
	$validator->addRule('email', array('email'));
	echo $validator->formValid();
}





?>


<form action="" method="post">
	<input type="text" name="name" placeholder="enter name" value="<?php echo $_POST['name']; ?>"><br>

	<?php echo $validator->outFieldError('name') ?>

	<br><input type="text" name="email" placeholder="enter email" value="<?php echo $_POST['email']; ?>"><br>

	<?php echo $validator->outFieldError('email') ?>
	<br>

	<input type="submit" value="Go">
</form>



*/

class Validator
{
	// for string from field names
	private $fields = array();

	// for storing errors for form fields
	private $fieldErrors = array();

	private $formIsValid = true;

	/**
	*  @param $fieldName string, name of field for class to watch
	*/
	public function addField($fieldName)
	{
		// add to array fields name of array
		$this->fields[] = $fieldName;


		// sub array, for multiple errors and messages for field
		$this->fieldErrors[$fieldName] = array();

	}


	public function AddRule($fieldName, $fieldRule)
	{
		$ruleName = $fieldRule[0];

		switch ($ruleName) {
			case 'min-length':
				
				if(strlen($_POST[$fieldName])<$fieldRule[1]){
					$this->addErrorToField($fieldName, "Field $fieldName must be at least {$fieldRule[1]} characters long");
				}

				break;
			case 'empty':
				if(strlen($_POST[$fieldName]) == 0){
					$this->addErrorToField($fieldName, "Field $fieldName cannot be empty");
				}
				break;

			case 'email':
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$this->addErrorToField($fieldName, "Please enter a valid email");
				}				
				
				break;


			default:
				# code...
				break;
		}

	}

	public function addErrorToField($fieldName, $errorMessage)
	{
		$this->formIsValid = false;

		$this->fieldErrors[$fieldName][] = $errorMessage;


	}

	public function outFieldError($fieldName)
	{
		if(isset($this->fieldErrors[$fieldName])){
			foreach ($this->fieldErrors[$fieldName] as $fieldError) {
				echo "<p class='errorMessage'>$fieldError</p>";
			}
		}
	}

	public function formValid()
	{
		return $this->formIsValid;
	}


}

