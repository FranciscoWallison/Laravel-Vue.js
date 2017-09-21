<?php

namespace SisFin\Presenters;

use SisFin\Transformers\StatementTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StatementPresenter
 *
 * @package namespace SisFin\Presenters;
 */
class StatementPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StatementTransformer();
    }
}
