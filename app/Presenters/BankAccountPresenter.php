<?php

namespace SisFin\Presenters;

use SisFin\Transformers\BankAccountTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BankAccountPresenter
 *
 * @package namespace SisFin\Presenters;
 */
class BankAccountPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BankAccountTransformer();
    }
}
