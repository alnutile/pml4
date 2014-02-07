<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    private function prepareForTests()
    {
        parent::setUp();
        Route::enableFilters();
        Artisan::call('migrate');
        $this->seed();
        Auth::loginUsingId(1);
        Mail::pretend(true);
    }

    public function setUp()
    {
        parent::setUp();
        $this->prepareForTests();
    }

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

}
