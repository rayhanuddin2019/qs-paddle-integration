<?php
namespace QS_Paddle_Integration\system;

final class App 
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services() 
	{
		 
		
		return [
		
		    // Base public Resource	
			\QS_Paddle_Integration\system\base\assets\Register::class,
			\QS_Paddle_Integration\base\assets\Assets::class,
		
	
			 // Base admin settings	
			\QS_Paddle_Integration\system\base\Meta::class,
			\QS_Paddle_Integration\system\base\dashboard\Page::class,
			\QS_Paddle_Integration\system\base\dashboard\Dashboard::class,
			
			\QS_Paddle_Integration\system\base\dashboard\controls\Widgets::class,
			\QS_Paddle_Integration\system\base\dashboard\controls\Modules::class,
			\QS_Paddle_Integration\system\base\dashboard\controls\Api::class,
				

		];

	}

	/**
	 * Loop through the classes, initialize them, 
	 * and call the register() method if it exists
	 * @return
	 */
	public static function register_services() 
	{
		foreach ( self::get_services() as $class ) {

			$service = self::instantiate( $class );
		
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}

		}
	}

	/**
	 * Initialize the class
	 * @param  class $class    class from the services array
	 * @return class instance  new instance of the class
	 */
	private static function instantiate( $class )
	{
		$service = new $class();

		return $service;
	}
}