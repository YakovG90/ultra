<?php
/**
 * Created by PhpStorm.
 * User: yakov
 * Date: 6/17/2018
 * Time: 12:11 PM
 */

namespace App\Controller;


use App\Entity\Member;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CharacterController extends Controller
{
    /** @Route("/characters/", name="list_characters") */
    public function listCharacters()
    {
        $members = $this->getDoctrine()->getRepository(Member::class)
            ->getMembers();

        $jsonData = [];
        foreach ($members as $member) {
            if ($member->getCharacterName() !== null || $member->getRealmName() !== null) {
                $jsonData[$member->getCharacterName()] = json_decode(@file_get_contents($member->getArmoryLink()), true);
            }
        }
        return $this->render('character/character-list.html.twig', ['members' => $members, 'jsonData' => $jsonData]);
    }
}