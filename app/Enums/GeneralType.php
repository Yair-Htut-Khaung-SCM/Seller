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
    const purpose_buy = "buy";
    const purpose_sale = "sale";
    const month = 01;
    const day = 01;
    const default_profile_name = "default_avatar";
    const profile_status = ["Normal User","Dealer","Agent"];
    const socialize_facebook = "facebook";
    const socialize_google = "google";
    const is_published = '1';
    const car_condition = ["Brand New","Used"];
    const fuels = ["Petrol", "Diesel", "CNG", "Electric"];
    const transmissions = ["Auto", "Manual", "Semi Auto"];
    const colors = ["black", "gray", "gold", "green", "red", "blue", "brown"];
    const steering_right = 'Right';
    const steering_left = 'Left';
    const post_old = "post_old";
    const post_new = "post_new";
    const latest_year_old = "latest_year_old";
    const latest_year = "latest_year";
    const build_type_id = "build_type_id";
    const ep_low_high = "low-high";
    const ep_high_low = "high-low";
    const engine_power = "engine_power";
    const price = "price";
    const default_mileage_min = '0';
    const default_mileage_max = '300000';
    const default_min_year = '2000';
    const default_min_price = '100';
    const default_max_price = '20000';
    const sort_name = "sort_name";

}
