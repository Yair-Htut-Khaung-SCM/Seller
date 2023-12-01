<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GeneralType extends Enum
{
    const PURPOSE_BUY = "buy";
    const PURPOSE_SALE = "sale";
    const MONTH = 01;
    const DAY = 01;
    const DEFAULT_PROFILE_NAME= "default_avatar";
    const PROFILE_STATUS = ["Normal User","Dealer","Agent"];
    const SOCIALIZE_FACEBOOK = "facebook";
    const SOCIALIZE_GOOGLE = "google";
    const IS_PUBLISHED = '1';
    const CAR_CONDITION = ["Brand New","Used"];
    const FUELS = ["Petrol", "Diesel", "CNG", "Electric"];
    const TRANSMISSIONS = ["Auto", "Manual", "Semi Auto"];
    const COLORS = ["black", "gray", "gold", "green", "red", "blue", "brown"];
    const STEERING_RIGHT = 'Right';
    const STEERING_LEFT = 'Left';
    const POST_OLD = "post_old";
    const POST_NEW = "post_new";
    const LATEST_YEAR_OLD = "latest_year_old";
    const LATEST_YEAR = "latest_year";
    const BUILD_TYPE_ID = "build_type_id";
    const EP_LOW_HIGH = "low-high";
    const EP_HIGH_LOW = "high-low";
    const ENGINE_POWER = "engine_power";
    const PRICE = "price";
    const DEFAULT_MILEAGE_MIN = '0';
    const DEFAULT_MILEAGE_MAX = '300000';
    const DEFAULT_MIN_YEAR = '2000';
    const DEFAULT_MIN_PRICE = '100';
    const DEFAULT_MAX_PRICE = '20000';
    const SORT_NAME = "sort_name";

}
