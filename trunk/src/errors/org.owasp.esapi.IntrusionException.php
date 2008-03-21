<?php
/**
 * OWASP Enterprise Security API (ESAPI)
 * 
 * This file is part of the Open Web Application Security Project (OWASP)
 * Enterprise Security API (ESAPI) project. For details, please see
 * http://www.owasp.org/esapi.
 *
 * Copyright (c) 2007 - The OWASP Foundation
 * 
 * The ESAPI is published by OWASP under the LGPL. You should read and accept the
 * LICENSE before you use, modify, and/or redistribute this software.
 * 
 * @author Jeff Williams <a href="http://www.aspectsecurity.com">Aspect Security</a>
 * @package org.owasp.esapi.errors
 * @created 2007
 */

/**
 * An IntrusionException should be thrown anytime an error condition arises that is likely to be the result of an attack
 * in progress. IntrusionExceptions are handled specially by the IntrusionDetector, which is equipped to respond by
 * either specially logging the event, logging out the current user, or invalidating the current user's account.
 * <P>
 * Unlike other exceptions in the ESAPI, the IntrusionException is a RuntimeException so that it can be thrown from
 * anywhere and will not require a lot of special exception handling.
 * 
 * @author Jeff Williams (jeff.williams@aspectsecurity.com)
 */
class IntrusionException extends RuntimeException {

    /** The Constant serialVersionUID. */
    private static $serialVersionUID = 1;

    /** The logger. */
    protected static $logger;

    protected $logMessage = null;

    /**
     * Internal classes may throw an IntrusionException to the IntrusionDetector, which generates the appropriate log
     * message.
     */
    public function IntrusionException() {
        // FIXME: AAA this shouldn't be public
        super();
    }

    /**
     * Creates a new instance of IntrusionException.
     * 
     * @param message the message
     * @param cause the cause
     */
    public function IntrusionException($userMessage, $logMessage, $cause) {
    	$logger = Logger::getLogger("ESAPI", "IntrusionException");
        super($userMessage, $cause);
        $this->logMessage = logMessage;
        $logger->logError(Logger.SECURITY, "INTRUSION - " + $this->logMessage, $cause);
    }

    public function getUserMessage() {
        return $this->getMessage();
    }

    public function getLogMessage() {
        return $this->logMessage;
    }

}
?>