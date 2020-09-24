<?php

/*
 * This file is part of the MusicBrainz package.
 *
 * © Anthony Totton <novocast7@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MusicBrainz\Entity;

use MusicBrainz\Entity\Entity;

class Rating extends Entity
{

    public $entity = 'rating';
    public $isCoreResource = false;
}
