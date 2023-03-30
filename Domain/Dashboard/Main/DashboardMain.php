<?php

namespace App\Domain\Dashboard\Main;

use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerRow;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerTitle;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Routes\Models\LinkGenerator;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Dashboard\Front\Attributes\BarCharAttribute;
use App\Domain\Dashboard\Front\Attributes\CurrentAttribute;
use App\Domain\Dashboard\Front\Attributes\DoughnutChartAttribute;
use App\Domain\Dashboard\Front\Attributes\StatisticAttribute;
use App\Domain\Dashboard\Models\Dashboard;
use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\Installment\Front\Admin\Path\TakenCreditRouteHandler;

class DashboardMain extends Dashboard implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([

            Container::newClass("mr-4 space-y-1", [

                ContainerRow::newClass("w-full", [
                    ContainerTitle::newTitle("Статистика",
                        "items-center block p-3 bg-white w-full h-full shadow-lg rounded", [
                            ContainerRow::newClass("justify-around w-full", [
                                StatisticAttribute::newLink(
                                    "fas fa-cash-register",
                                    TakenCredit::class . "::count('taken_credits.id')",
                                    TakenCredit::class . "::today()->count('taken_credits.id')",
                                    "Рассрочки",
                                    LinkGenerator::new(TakenCreditRouteHandler::new())->index([
                                        'today' => true,
                                        'title_for_credit' => '"за сегодняшний день"'
                                    ]),
                                    LinkGenerator::new(TakenCreditRouteHandler::new())->index(),
                                ),
                                StatisticAttribute::newLink(
                                    "fas fa-address-book",
                                    TakenCredit::class . "::unpaidCreditCount()",
                                    TakenCredit::class . "::today()->unpaidCreditCount()",
                                    "Просроченные рассрочки",
                                    LinkGenerator::new(TakenCreditRouteHandler::new())->index([
                                        'today' => true,
                                        'unpaid' => true,
                                        'title_for_credit' => '"за сегодняшний день просроченные"'
                                    ]),
                                    LinkGenerator::new(TakenCreditRouteHandler::new())->index([
                                        'unpaid' => true,
                                        'title_for_credit' => '"просроченные"'
                                    ]),
                                ),
                                StatisticAttribute::new(
                                    "fas fa-calendar-day",
                                    TakenCredit::class . "::amountOfUnpaidCreditShow()",
                                    TakenCredit::class . "::today()->amountOfUnpaidCreditShow()",
                                    "За должность",
//                                    LinkGenerator::new(TakenCreditRouteHandler::new())->index(),
//                                    LinkGenerator::new(TakenCreditRouteHandler::new())->index(),

                                ),
                                CurrentAttribute::newLink(
                                    "fas fa-money-bill-wave",
                                    TakenCredit::class . "::accepted()->count()",
                                    TakenCredit::class . "::acceptedAmountToPayShow()",
                                    "Действующие рассрочки",
                                    "",
                                    LinkGenerator::new(TakenCreditRouteHandler::new())->index([
                                        'accepted' => true,
                                            'title_for_credit' => '"действующие"'

                                    ]),
                                )
                            ])
                        ]),

                ]),
                ContainerRow::new([
                    'class' => ""
                ], [
                    BarCharAttribute::new(),
                    DoughnutChartAttribute::new(),

                ]),

//                ContainerRow::newClass("justify-between", [
//
//                    Container::new([
////                        ':class' => 'isSideBarOpen && `max-w-[60vw]` || `max-w-[45vw]`',
//                    ], [
//                        BoxTitleContainer::newTitle(
//                            "Новые Рассрочки",
//                            " overflow-x-auto"
//                            , [
//                            new FileLivewireWithoutActionFilterBy("DashboardMain", TakenCreditNew::new()),
//
//                        ]),
//                    ]),
//
//                    BoxTitleContainer::newTitle(
//                        "Новые заказы",
//                        " block overflow-x-auto w-min",
//                        [
//                            new FileLivewireWithoutActionFilterBy("DashboardMain", PaymentFiltered::new()),
//                        ])
//                ]),
            ])
        ]);
    }

    public function getTitle()
    {
        return "Главная";
    }
}
