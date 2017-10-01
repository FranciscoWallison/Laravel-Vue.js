<?php

namespace SisFin\Http\Controllers\Site;

use SisFin\Http\Controllers\Controller;
use SisFin\Http\Requests\SubscriptionCreateRequest;
use SisFin\Repositories\PlanRepository;
use Illuminate\Support\Facades\Auth;

use SisFin\Iugu\Exceptions\AbstractIuguException;
use SisFin\Iugu\Exceptions\IuguCustomerException;
use SisFin\Iugu\Exceptions\IuguPaymentMethodException;
use SisFin\Iugu\Exceptions\IuguSubscriptionException;
use SisFin\Iugu\IuguSubscriptionManager;

class SubscriptionsController extends Controller
{
    /**
     * @var PlanRepository
     */
    private $planRepository;
    /**
     * @var IuguSubscriptionManager
     */
    private $iuguSubscriptionManager;

    public function __construct(PlanRepository $planRepository, IuguSubscriptionManager $iuguSubscriptionManager)
    {
        $this->planRepository = $planRepository;
        $this->iuguSubscriptionManager = $iuguSubscriptionManager;
    }

    public function create()
    {
        $plan = $this->planRepository->all()->first();
        return view('site.subscriptions.create', compact('plan'));
    }

    public function store(SubscriptionCreateRequest $request)
    {
        $plan = $this->planRepository->all()->first();

        try {
            $this->iuguSubscriptionManager->create(
                Auth::user(), $plan, $request->all()
            );
            //TO:DO mandar o codigo de barra do boleto pelo E-mail
        } catch (AbstractIuguException $e) {
            $request->session()->flash('error',$this->getMessageException($e));
            return redirect()->route('site.subscriptions.create');
        }

        return redirect()->route('site.subscriptions.successfully');
    }

    public function successfully()
    {
        return view('site.subscriptions.successfully');
    }

    protected function getMessageException($exception)
    {
        if ($exception instanceof IuguCustomerException) {
            return 'Erro ao processar cliente. Contacte o atendimento para mais detalhes.';
        } elseif ($exception instanceof IuguPaymentMethodException) {
            return 'Erro ao salvar método de pagamento. Contacte o atendimento para mais detalhes.';
        }elseif ($exception instanceof IuguSubscriptionException) {
            return 'Erro ao processar assinatura. Contacte o atendimento para mais detalhes.';
        }
    }

    public function invite()
    {
        return view('site.invite');
    }

    public function inviteCreat(UserRegisterRequest $request)
    {
        $clientData = $request->get('client');//crirar primeiro o cliente tenacy
        $client = $this->clientRepository->create($clientData);

        $data = $request->except('client');
        $data['client_id'] = $client->id;
        $user = $this->userRepository->create($data);

        Auth::loginUsingId($user->id);
        return redirect()->route('site.subscriptions.create');
    }

}