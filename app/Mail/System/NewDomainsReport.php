<?php

namespace App\Mail\System;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewDomainsReport extends Mailable
{
    use Queueable, SerializesModels;

	public $domains;
	protected $fileData;

    public function __construct(Collection $domains)
    {
		$this->domains = $domains;
		$this->generateCsv();
    }

	public function generateCsv()
	{
		$csv = 'Domain,Locale' . PHP_EOL;

		foreach ($this->domains as $domain) {
			$csv .= "\"{$domain->domain}\",\"{$domain->locale}\"" . PHP_EOL;
		}

		$this->fileData = $csv;
	}

    public function build()
    {
        $this
            ->subject('New Domains Report')
			->view('mails.system.new-domains-report')
			->attachData($this->fileData, 'new_domains.csv', [
				'mime' => 'text/csv',
			]);
    }
}
