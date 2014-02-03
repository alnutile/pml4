<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    public function __call($method, $parameters)
    {
        return Response::error('404');
    }

    protected function param($param = null)
    {
        return array_get(Request::route()->parameters, $param, null);
    }

    protected function current_user()
    {
        return IoC::resolve('current_user');
    }

}