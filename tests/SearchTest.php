<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class SearchTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testSearchingByName()
    {
        $this->get('/hotels?q=Rotana');
        $searchResult = json_encode(['hotels' => [[
                'name'=>'Rotana Hotel',
                'price'=>80.6,
                'city'=> 'cairo' ,
                'availability'=> [
                                ['from'=>'10-10-2020','to'=>'12-10-2020'],
                                ['from'=>'25-10-2020','to'=>'10-11-2020'],
                                ['from'=>'05-12-2020','to'=>'18-12-2020']
                ]
            ]]]);
        $this->assertEquals(
            $searchResult, $this->response->getContent()
        );
    }

    public function testSeachWithSortingBy(){
        $this->get('/hotels?q=hot&sortby=Name,Price');
        $searchResult = json_encode(['hotels' => [
            [
                'name'=>'Concorde Hotel',
                'price'=>79.4,
                'city'=> 'Manila' ,
                'availability'=> [
                    ['from'=>'10-10-2020','to'=>'19-10-2020'],
                    ['from'=>'22-10-2020','to'=>'22-11-2020'],
                    ['from'=>'03-12-2020','to'=>'20-12-2020']
                ]
            ],[
                'name'=>'Rotana Hotel',
                'price'=>80.6,
                'city'=> 'cairo' ,
                'availability'=> [
                    ['from'=>'10-10-2020','to'=>'12-10-2020'],
                    ['from'=>'25-10-2020','to'=>'10-11-2020'],
                    ['from'=>'05-12-2020','to'=>'18-12-2020']
                ]
            ],[
                'name'=>'Media One Hotel',
                'price'=>102.2,
                'city'=> 'dubai' ,
                'availability'=> [
                    ['from'=>'10-10-2020','to'=>'15-10-2020'],
                    ['from'=>'25-10-2020','to'=>'15-11-2020'],
                    ['from'=>'10-12-2020','to'=>'15-12-2020']
                ]
            ],[
                'name'=>'Novotel Hotel',
                'price'=>111,
                'city'=> 'Vienna' ,
                'availability'=> [
                    ['from'=>'20-10-2020','to'=>'28-10-2020'],
                    ['from'=>'04-11-2020','to'=>'20-11-2020'],
                    ['from'=>'08-12-2020','to'=>'24-12-2020']
                ]
            ]

        ]]);
        $this->assertEquals(
            $searchResult, $this->response->getContent()
        );
    }
}
