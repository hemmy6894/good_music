<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $name ?? "ANASTAZIA WILSON MCHEMBE" }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <table class="table table-striped table-sm" style="width:60% !important">
        <tbody>
            <tr>
                <td colspan="2"></td>
            </tr>
            <tr>
                <th class="2">{{ $name ?? "ANASTAZIA WILSON MCHEMBE" }}</th>
            </tr> 
            <tr>
                <td colspan="2">
                    {{ $department ?? "ACCOUNTANT"}}
                </td>
            </tr>
            <tr>
                <th>
                    @lang('words.employee_no')
                </th>
                <td>
                    {{ $employee_no ?? "PRC001"}}
                </td>
            </tr>
            <tr>
                <th>
                    @lang('words.pay_point')
                </th>
                <td>
                    {{ $paypoint ?? "HQ" }}
                </td>
            </tr>
            <tr>
                <th>
                    @lang('words.pension_no')
                </th>
                <td>
                    {{ $pension_no ?? "667632767"}}
                </td>
            </tr>
            <tr>
                <th>
                    @lang('words.account_no')
                </th>
                <td>
                    {{ $account_no ?? "2123673257" }}
                </td>
            </tr>
            <tr>
                <th colspan="2" class="text-center"> November - 2019 Payment Slip (TZS) </th>
            </tr>
            <tr>
                <th>@lang('words.gross_earnings')</th>
                <th class="text-right">@lang('words.amount')</th>
            </tr>
            <tr>
                <td>
                    @lang('words.basic_salary')
                </td>
                <td class="text-right">
                    {{ $basic_salary ?? "500,000"}}
                </td>
            </tr>
            <tr>
                <th>@lang('words.total')</th>
                <th class="text-right">{{ $gross_earning_total ?? "500,000"}}</th>
            </tr>
            <tr>
                <th>@lang('words.gross_deductions')</th>
                <th class="text-right">@lang('words.amount')</th>
            </tr>
            <tr>
                <td>
                    @lang('words.paye')
                </td>
                <td class="text-right">
                    {{ $basic_salary ?? "100,000"}}
                </td>
            </tr>
            <tr>
                <td>@lang('words.pspf_nssf')</td>
                <td class="text-right">{{ $basic_salary ?? "100,000"}}</td>
            </tr>
            <tr>
                <th>@lang('words.total')</th>
                <th class="text-right">{{ $gross_deduction_total ?? "200,000"}}</th>
            </tr>
            <tr>
                <th>@lang('words.company_contributions')</th>
                <th class="text-right">@lang('words.amount')</th>
            </tr>
            <tr>
                <td>@lang('words.pspf_nssf_employee')</td>
                <td class="text-right">{{ $pspf_nssf_employee ?? "100,000"}}</td>
            </tr>
            <tr>
                <th>@lang('words.total')</th>
                <th class="text-right">{{ $pspf_nssf_employee_total ?? "100,000"}}</th>
            </tr>
            <tr>
                <th>@lang('words.tax_analysis')</th>
                <th class="text-right">@lang('words.amount')</th>
            </tr>
            <tr>
                <td>@lang('words.taxample_income')</td>
                <td class="text-right">{{ $taxample_income ?? "10,000"}}</td>
            </tr>
            <tr>
                <td>@lang('words.tax_exemptions')</td>
                <td class="text-right">{{ $tax_exemptions ?? "10,000"}}</td>
            </tr>
            <tr>
                <th>@lang('words.taxable_amount')</th>
                <th class="text-right">{{ $taxable_amount ?? "20,000"}}</th>
            </tr>
            <tr>
                <th>@lang('words.net_pay')</th>
                <th class="text-right">{{ $net_pay ?? "300,000"}}</th>
            </tr>
        </tbody>
    </table>
</body>
</html>