<?php

namespace Drupal\ranking_field\Controller;

use Drupal;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

class RankingController extends ControllerBase
{

    const RANK_TABLE_PREFIX = 'node__';

    /**
     * @param $table
     * @param $nid
     * @param $stars
     * @throws \Exception
     */
    public function updateRank()
    {

        $table = \Drupal::request()->query->get('table');
        $stars = \Drupal::request()->query->get('stars');
        $nid = \Drupal::request()->query->get('nid');

        $this->addRateByOrm($table, $stars, $nid);

        die;

    }

    /**
     * @param $table
     * @param $stars
     * @param $nid
     * @throws Drupal\Core\Entity\EntityStorageException
     */
    private function addRateByOrm($table, $stars, $nid)
    {
        $node = Node::load($nid);
        $raters = $node->get($table)->getValue()[0]['number_of_raters'];
        $oldStars = $node->get($table)->getValue()[0]['number_of_stars'];
        $node->set($table, [
            'number_of_raters' => $raters + 1,
            'number_of_stars' => $oldStars + $stars,
        ]);
        $node->save();
    }

}