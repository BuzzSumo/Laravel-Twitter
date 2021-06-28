<?php namespace Philo\Twitter;

use Config;

class Twitter extends \TijsVerkoyen\Twitter\Twitter{

	/**
	 * Default constructor
	 *
	 * @param string $consumerKey    The consumer key to use.
	 * @param string $consumerSecret The consumer secret to use.
	 */
	public function __construct()
	{
	    $this->setConsumerKey( config('services.twitter.consumer_key', false) );
	    $this->setConsumerSecret( config('services.twitter.consumer_secret', false) );
	}
	
	public function directMessagesNew(
        $userId = null, $screenName = null, $text = ''
    )
    {
        // validate
        if ($userId == null && $screenName == null) {
            throw new Exception('One of user_id or screen_name are required.');
        }

        // build parameters
        $parameters['text'] = (string) $text;
        if ($userId != null) {
            $parameters['user_id'] = (string) $userId;
        }
        if ($screenName != null) {
            $parameters['screen_name'] = (string) $screenName;
        }

        // make the call
        return $this->doCall(
            'direct_messages/new.json',
            $parameters, true, 'POST'
        );
    }

}
