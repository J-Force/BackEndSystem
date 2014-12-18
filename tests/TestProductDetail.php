<?php

class TestLogin extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		$response = $this->action('GET', 'ProductController@showDetail', array('id' => 1));

		$view = $response->original;

		$this->assertEquals(10, $view['id']);
	}

}
