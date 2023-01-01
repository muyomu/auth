<?php

namespace muyomu\auth\generic;

use muyomu\database\base\Document;
use muyomu\database\DbClient;
use muyomu\http\Request;
use muyomu\http\Response;

interface Dynamic
{
    public function dpara(Request $request,Response $response,DbClient $dbClient): Document | null;
}