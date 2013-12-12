<?php
/**
 * Message Model File.
 *
 * Messages.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */

namespace Model;

/**
 * Message Model.
 *
 * Messages.
 *
 * @package   SecurityApplication
 * @author    Marie Hogebrandt <iam@mariehogebrandt.se>
 * @copyright 2013-2014 Marie Hogebrandt
 * @license   http://opensource.org/licenses/MIT MIT
 * @link      https://github.com/Melindrea/security-application
 */
class Message extends \Eloquent
{
    protected $guarded = array();

    protected static $rules = array(
        'subject'                        => 'required|min:3|max:128',
        'content'                        => 'required|min:3|max:500',
    );

    /**
     * Array used by FactoryMuff to create Test objects
     */
    public static $factory = array(
        'subject'                       => 'string',
        'type_id'                       => 'integer',
        'content'                       => 'text',
        // Will be the id of an existent User.
        'user_id'                       => 'factory|Model\User',
    );

    public function user()
    {
        return $this->belongsTo('Model\User');
    }
}
