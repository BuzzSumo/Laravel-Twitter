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

	 /**
     * Sends a new direct message to the specified user from the authenticating user. Requires both the user and text parameters and must be a POST. Returns the sent message in the requested format if successful.
     *
     * @param  string[optional] $userId     The ID of the user who should receive the direct message. Helpful for disambiguating when a valid user ID is also a valid screen name.
     * @param  string[optional] $screenName The screen name of the user who should receive the direct message. Helpful for disambiguating when a valid screen name is also a user ID.
     * @param  string           $text       The text of your direct message. Be sure to URL encode as necessary, and keep the message under 140 characters.
     * @return array
     */
    public function directMessagesNew(
        $userId = null, $screenName = null, $text = null
    )
    {
        // validate
        if ($userId == null && $screenName == null) {
            throw new Exception('One of user_id or screen_name are required.');
        }
        // validate
        if ($text == null) {
            throw new Exception('text is required.');
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
