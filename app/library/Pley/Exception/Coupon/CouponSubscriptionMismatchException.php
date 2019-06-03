<?php /** @copyright Pley (c) 2017, All Rights Reserved */

namespace Pley\Exception\Coupon;

use Pley\Exception\ExceptionCode;
use Pley\Http\Response\ExceptionInterface;
use Pley\Http\Response\ResponseCode;

/**
 * The <kbd>CouponSubscriptionMismatchException</kbd> represents the exception raised when trying
 * to redeem a coupon which subscriptionId does not equal to subscriptionId, which is being purchased.
 *
 * @author Vsevolod Yatsuk (vsevolod.yatsuk@agileengine.com)
 * @version 1.0
 * @package Pley.Coupon.Exception
 * @subpackage Exception
 */
class CouponSubscriptionMismatchException extends \RuntimeException implements ExceptionInterface
{
    public function __construct(
        \Pley\Entity\Coupon\Coupon $coupon,
        \Pley\Entity\User\User $user,
        $subscriptionId,
        \Exception $previous = null
    )
    {
        $message = json_encode([
            'couponId' => $coupon->getId(),
            'userId' => $user->getId(),
            '$subscriptionId' => $subscriptionId
        ]);
        parent::__construct($message, ExceptionCode::COUPON_SUBSCRIPTION_MISMATCH, $previous);
    }

    /** {@inheritdoc} */
    public function getHttpCode()
    {
        return ResponseCode::HTTP_CONFLICT;
    }
}
