<?php
/**
 * Invoice Ninja (https://invoiceninja.com)
 *
 * @link https://github.com/invoiceninja/invoiceninja source repository
 *
 * @copyright Copyright (c) 2020. Invoice Ninja LLC (https://invoiceninja.com)
 *
 * @license https://opensource.org/licenses/AAL
 */

namespace App\Services\Invoice;

use App\Models\Invoice;
use App\Services\AbstractService;

class UpdateBalance extends AbstractService
{

    private $invoice;

    private $balance_adjustment;

    public function __construct($invoice, $balance_adjustment)
    {
        $this->invoice = $invoice;
        $this->balance_adjustment = $balance_adjustment;
    }


  	public function run()
  	{

        if ($this->invoice->is_deleted) {
            return;
        }

        $this->invoice->balance += floatval($this->balance_adjustment);

        if ($this->invoice->balance == 0) {
            $this->invoice->status_id = Invoice::STATUS_PAID;
            // $this->save();
            // event(new InvoiceWasPaid($this, $this->company));

        }

        return $this->invoice;
  	}
}
