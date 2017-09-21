<?php

namespace SisFin\Presenters;

use SisFin\Transformers\BankTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BankPresenter
 *
 * @package namespace SisFin\Presenters;
 */
class BankPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BankTransformer();
    }
}
