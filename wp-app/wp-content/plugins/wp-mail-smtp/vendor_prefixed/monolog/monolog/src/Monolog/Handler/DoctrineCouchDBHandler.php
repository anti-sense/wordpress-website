<?php

declare (strict_types=1);
/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WPMailSMTP\Vendor\Monolog\Handler;

use WPMailSMTP\Vendor\Monolog\Logger;
use WPMailSMTP\Vendor\Monolog\Formatter\NormalizerFormatter;
use WPMailSMTP\Vendor\Monolog\Formatter\FormatterInterface;
use WPMailSMTP\Vendor\Doctrine\CouchDB\CouchDBClient;
/**
 * CouchDB handler for Doctrine CouchDB ODM
 *
 * @author Markus Bachmann <markus.bachmann@bachi.biz>
 */
class DoctrineCouchDBHandler extends \WPMailSMTP\Vendor\Monolog\Handler\AbstractProcessingHandler
{
    /** @var CouchDBClient */
    private $client;
    public function __construct(\WPMailSMTP\Vendor\Doctrine\CouchDB\CouchDBClient $client, $level = \WPMailSMTP\Vendor\Monolog\Logger::DEBUG, bool $bubble = \true)
    {
        $this->client = $client;
        parent::__construct($level, $bubble);
    }
    /**
     * {@inheritDoc}
     */
    protected function write(array $record) : void
    {
        $this->client->postDocument($record['formatted']);
    }
    protected function getDefaultFormatter() : \WPMailSMTP\Vendor\Monolog\Formatter\FormatterInterface
    {
        return new \WPMailSMTP\Vendor\Monolog\Formatter\NormalizerFormatter();
    }
}
