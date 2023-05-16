<?php

namespace App\Repositories\Organization;

use App\Http\Requests\BeerTypeRequestPost;
use App\Models\BeerType;
use App\Models\BranchDetail;
use App\Repositories\BaseRepository;

/**
 * Class BeerTypeRepository
 * @package App\Repositories\Organization.
 */
class BeerTypeRepository extends BaseRepository
{
    /**
     * @var string.
     */
    protected $modelClass = BeerType::class;

    /**
     * Adiciona um tipo de cerveja e relaciona ela com um bar quando o tipo estiver sendo adicionado pelo admin do bar.
     * @param BeerTypeRequestPost $request
     */
    public function add(BeerTypeRequestPost $request)
    {
        $data = $request->all();
        if($request->get('branch_id') == BranchDetail::SUPER_ADM_BAR) {
            $data['status'] = BeerType::STATUS_APPROVED;
        }

        return $this->create($data);
    }

}
