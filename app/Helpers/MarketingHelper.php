<?php

namespace App\Helpers;

class MarketingHelper
{
    const STATUS_DRAFT = 'Draft';
    const STATUS_RESUBMIT = 'Resubmit';
    const STATUS_SAVED = 'Saved';

    const MODEL = [
        'Bulletin',
        'Marquee',
        'SlidingBanner',
        'MessageBlast',
        'LoadingImage',
        'NewsPaper',
    ];

    //tagging for transaction
    const BULLETIN = 0;
    const MARQUEE = 1;
    const SLIDING_BANNER = 2;
    const MESSAGE_BLAST = 3;
    const LOADING_IMAGE = 4;
    const NEWSPAPER = 5;
}
