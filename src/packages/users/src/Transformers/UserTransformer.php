<?php

namespace GGPHP\Users\Transformers;

use GGPHP\Core\Transformers\BaseTransformer;
use GGPHP\Users\Models\User;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserTransformer extends BaseTransformer
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Array attribute doesn't parse.
     */
    public $ignoreAttributes = [];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['division', 'fixedCosts', 'notFixedCosts'];

    /**
     * Transform the User entity.
     *
     * @param User $model
     *
     * @return array
     */
    public function customAttributes($model): array
    {
        return [
        ];
    }

    /**
     * Include User
     * @param  User $user
     */
    public function includeDivision(User $user)
    {
        if (empty($user->division)) {
            return;
        }
        return $this->item($user->division, new \GGPHP\Division\Transformers\DivisionTransformer, 'Division');
    }

    /**
     * Include fixedCosts
     * @param  User $user
     */
    public function includeFixedCosts(User $user)
    {
        return $this->collection($user->fixedCosts, new \GGPHP\Cost\Transformers\FixedCostTransformer, 'FixedCost');
    }

    /**
     * Include notFixedCosts
     * @param  User $user
     */
    public function includeNotFixedCosts(User $user)
    {
        return $this->collection($user->notFixedCosts, new \GGPHP\Cost\Transformers\NotFixedCostTransformer, 'NotFixedCosts');
    }
}
