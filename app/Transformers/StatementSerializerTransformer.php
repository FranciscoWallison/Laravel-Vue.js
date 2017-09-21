<?php

namespace SisFin\Transformers;

use SisFin\Presenters\StatementPresenter;
use SisFin\Serializer\StatementSerializer;
use League\Fractal\TransformerAbstract;

/**
 * Class StatementSerializerTransformer
 * @package namespace SisFin\Transformers;
 */
class StatementSerializerTransformer extends TransformerAbstract
{
    /**
     * @var StatementPresenter
     */
    private $statementPresenter;

    /**
     * StatementSerializerTransformer constructor.
     * @param StatementPresenter $statementPresenter
     */
    public function __construct(StatementPresenter $statementPresenter)
    {
        $this->statementPresenter = $statementPresenter;
    }

    /**
     * @param StatementSerializer $serializer
     * @return array
     * @throws \Exception
     */
    public function transform(StatementSerializer $serializer)
    {
        //statemesnts => lançamentos ...
        return [
            'statements' => $this->statementPresenter->present($serializer->getStatements()),
            'statement_data' => $serializer->getStatementData(),
        ];
    }
}
