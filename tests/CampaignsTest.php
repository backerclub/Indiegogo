<?php

namespace BackerClub\IndiegogoApiClient\Tests;

use BackerClub\IndiegogoApiClient\Entity\Campaign;
use BackerClub\IndiegogoApiClient\Entity\CampaignUpdate;
use BackerClub\IndiegogoApiClient\Entity\TeamMember;
use BackerClub\IndiegogoApiClient\Response\CampaignsResponse;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class CampaignsTest extends ClientTestCase
{
    public function testCampaignsRequestReturnsCampaignsResponseObject()
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__ . '/fixtures/campaigns.json')),
        ]);

        $indiegogo = $this->createIndiegogoClient($mock);

        $campaignsResponse = $indiegogo->campaigns();

        $this->assertInstanceOf(CampaignsResponse::class, $campaignsResponse);
    }

    public function testCampaignLatestUpdatesAndTeamMembersAreEntityObjects()
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__ . '/fixtures/campaigns.json')),
        ]);

        $indiegogo = $this->createIndiegogoClient($mock);

        $campaignsResponse = $indiegogo->campaigns();

        $firstCampaign = $campaignsResponse->getResponse()[0];

        $this->assertInstanceOf(Campaign::class, $firstCampaign);
        $this->assertInstanceOf(CampaignUpdate::class, $firstCampaign->getLatestUpdates()[0]);
        $this->assertInstanceOf(TeamMember::class, $firstCampaign->getTeamMembers()[0]);
    }

    public function testCampaignIsFixedFundingType()
    {
        // Given a campaign with fixed funding created from JSON extracted from an API response
        $campaign = new Campaign(
            json_decode(
                file_get_contents(__DIR__ . '/fixtures/campaigns/fixed_funding.json'),
                false
            )
        );

        // We expect the funding type to be fixed.
        $this->assertSame('fixed', $campaign->getFundingType());

        // We expected isFixedFundingType is true.
        $this->assertTrue($campaign->isFixedFundingType());
    }

    public function testCampaignIsFlexibleFundingType()
    {
        // Given a campaign with a flexible funding type created from JSON.
        $campaign = new Campaign(
            json_decode(
                file_get_contents(__DIR__ . '/fixtures/campaigns/flexible_funding.json'),
                false
            )
        );

        // We expect the funding type to be flexible.
        $this->assertSame('flexible', $campaign->getFundingType());

        // We expect that isFlexibleFundingType to be True
        $this->assertTrue($campaign->isFlexibleFundingType());
    }
}
