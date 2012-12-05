<?php
class ErrorController extends Zend_Controller_Action {
	
	public function errorAction()
	{
			$errors = $this->_getParam('error_handler');
	 
			switch ($errors->type) {
				case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
				case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
				case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
					// 404 error -- controller or action not found
					$this->getResponse()
						 ->setRawHeader('HTTP/1.1 404 Not Found');
	 
					// ... get some output to display...
					break;
				default:
					// application error; display error page, but don't change
					// status code
	 
					// ...
	 
					// Log the exception:
					$exception = $errors->exception;
					echo "<pre>" . $exception->getMessage() ;
					echo $exception->getTraceAsString();
					
					/*
					$log = new Zend_Log(
						new Zend_Log_Writer_Stream(
							'/tmp/applicationException.log'
						)
					);
					$log->debug($exception->getMessage() . "\n" .
								$exception->getTraceAsString());
					*/
					break;
			}
			die;
	}
}
?>