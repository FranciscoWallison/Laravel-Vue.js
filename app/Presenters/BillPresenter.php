<?php

namespace CodeFin\Presenters;

use CodeFin\Transformers\BillTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BillPresenter
 *
 * @package namespace CodeFin\Presenters;
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
