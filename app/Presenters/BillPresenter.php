<?php

namespace SisFin\Presenters;

use SisFin\Transformers\BillTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BillPresenter
 *
 * @package namespace SisFin\Presenters;
 */
class BillPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BillTransformer();
    }
}
