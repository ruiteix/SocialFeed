<?php

/*
 * This file is part of the Social Feed Util.
 *
 * (c) LaNetscouade <contact@lanetscouade.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Lns\SocialFeed\Model;

/**
 * Tweet.
 */
class Tweet extends AbstractPost implements PostInterface {

  protected $followersCount;

  public function getType() {
    return 'tweet';
  }

  public function getFollowersCount() {
    return $this->followersCount;
  }

  /**
   * setIdentifier.
   *
   * @param $followersCount
   */
  public function setFollowersCount($followersCount) {
    $this->followersCount = $followersCount;

    return $this;
  }

}
