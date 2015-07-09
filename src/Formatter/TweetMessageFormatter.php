<?php

namespace Lns\SocialFeed\Formatter;

use Lns\SocialFeed\Model\ReferenceType;

class TweetMessageFormatter extends AbstractMessageFormatter
{
    protected function formatMessagePart($messagePart) {
        $reference = $messagePart['reference'];

        if(!$reference) {
            return $messagePart['text'];
        }

        $data = $reference->getData();

        switch($reference->getType()) {
        case ReferenceType::URL:
            return $this->createLinkString($data['expanded_url'], $data['display_url']);
            break;
        case ReferenceType::USER:
            return $this->createLinkString('https://twitter.com/'. $data['screen_name'], $messagePart['text']);
            break;
        case ReferenceType::HASHTAG:
            return $this->createLinkString('https://twitter.com/hashtag/' . $data['text'], $messagePart['text']);
            break;
        case ReferenceType::VIDEO:
            return $this->createLinkString($data['expanded_url'], $messagePart['display_url']);
            break;
        default:
            return null;
            break;
        }
    }
}
