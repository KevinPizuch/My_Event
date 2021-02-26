<?php

namespace App\Controller;

header("Access-Control-Allow-Origin: *");
use App\Repository\UsersRepository;
use App\Entity\Users;
use App\Entity\EventGrp;
use App\Entity\ChatMsg;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints\DateTime;
/**
 * @Route("/api", name="api")
 */
class ApiController extends AbstractController
{
    private $usersRepository;
    public function __construct(EntityManagerInterface $entityManager, UsersRepository $usersRepository){
        $this->entityManager = $usersRepository;
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/user/check", name="user_check", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function userCheck(Request $request, EntityManagerInterface $entityManager){
        $array = [];
        $array = json_decode($request->getContent(), true);
        if(!$array){
            return new JsonResponse('error');
        }
        $repository = $this->getDoctrine()->getRepository(Users::class);
        $userEmail = $repository->findOneBy(['email' => $array['email']]);
        if(!$userEmail){
            $entityManager = $this->getDoctrine()->getManager();

            $user = new Users();
            $user->setName($array['name']);
            $user->setEmail($array['email']);
            $user->setPicture($array['picture']);
            $user->setIdUser($array['id_user']);

            $entityManager->persist($user);
            $entityManager->flush();

            return new JsonResponse('created');
        }
        return new JsonResponse('connected');
    }
    /**
     * @Route("/user/connected", name="stay_connected", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function userConnected(Request $request, EntityManagerInterface $entityManager){
        $array = [];
        $array = json_decode($request->getContent(), true);
        if(!$array){
            return new JsonResponse('error');
        }
        $repository = $this->getDoctrine()->getRepository(Users::class);
        $userId = $repository->findOneBy(['id_user' => $array['user_id']]);
        if(!$userId){
            return new JsonResponse('error');
        }
        $entityManager = $this->getDoctrine()->getManager();

        return new JsonResponse([
            'name'=>$userId->getName(), 
            'email'=>$userId->getEmail(), 
            'picture'=>$userId->getPicture()
        ]);
    }
    /**
     * @Route("/user/newevent", name="new_event", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function createEvent(Request $request, EntityManagerInterface $entityManager){
        $array = [];
        $array = json_decode($request->getContent(), true);
        if(!$array){
            return new JsonResponse('error no argument');
        }
        $repository = $this->getDoctrine()->getRepository(EventGrp::class);
        $owner = $repository->findOneBy(['name' => $array['owner_name'],'id_event' => $array['id_event']]);
        if(!$owner){
            $entityManager = $this->getDoctrine()->getManager();
            $token = $token = bin2hex(random_bytes(80));
            $event = new EventGrp();
            $event->setOwner($array['owner_name']);
            $event->setIdEvent($array['id_event']);
            $event->setName($array['guest_name']);
            $event->setPicture($array['guest_picture']);
            $event->setIdGrp($token);
            $event->setStatus('owner');

            $entityManager->persist($event);
            $entityManager->flush();

            return new JsonResponse('created');
        }else{
            return new JsonResponse('already created by this person');
        }
    }
    /**
     * @Route("/user/newguest", name="new_guest", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function newGuest(Request $request, EntityManagerInterface $entityManager){
        // add already in grp
        $array = [];
        $array = json_decode($request->getContent(), true);
        if(!$array){
            return new JsonResponse('error');
        }
        $repository = $this->getDoctrine()->getRepository(Users::class);
        $userName = $repository->findOneBy(['name' => $array['user_name']]);
        if(!$userName){
            return new JsonResponse('error');
        }
        $entityManager = $this->getDoctrine()->getManager();

        $owner = $repository->findOneBy(['name' => $array['owner']]);
        $repository2 = $this->getDoctrine()->getRepository(EventGrp::class);
        $ownerGrp = $repository2->findOneBy(['name' => $array['owner'], 'id_event'=>$array['id_event']]);
        $newGuest = new EventGrp();
        $newGuest->setOwner($ownerGrp->getName());
        $newGuest->setIdGrp($ownerGrp->getIdGrp());
        $newGuest->setIdEvent($ownerGrp->getIdEvent());
        $newGuest->setName($userName->getName());
        $newGuest->setPicture($userName->getPicture());
        $newGuest->setStatus('member');
        
        $entityManager->persist($newGuest);
        $entityManager->flush();

        return new JsonResponse('created');
    }
    /**
     * @Route("/user/getguests", name="get_guest", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getGuests(Request $request, EntityManagerInterface $entityManager){
        $array = [];
        $array = json_decode($request->getContent(), true);
        if(!$array){
            return new JsonResponse('error');
        }
        $repository = $this->getDoctrine()->getRepository(EventGrp::class);
        $guestList = $repository->findBy(['owner' => $array['owner'], 'id_event' => $array['id_event']]);
        $array1 = [];
        foreach($guestList as $guest){
            $array1[] = $guest->toArray();
        }
        return new JsonResponse($array1);
        
    }
    /**
     * @Route("/user/isowner", name="is_owner", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function isOwner(Request $request, EntityManagerInterface $entityManager){
        $array = [];
        $array = json_decode($request->getContent(), true);
        if(!$array){
            return new JsonResponse('error');
        }
        $repository = $this->getDoctrine()->getRepository(EventGrp::class);
        $guestList = $repository->findOneBy(['owner' => $array['owner'], 'id_event' => $array['id_event']]);
        if(!$guestList){
            return new JsonResponse('false');
        }else{
            return new JsonResponse('true');
        }

    }
    /**
     * @Route("/user/newmsg", name="new_msg", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function newMsg(Request $request, EntityManagerInterface $entityManager){
        $array = [];
        $array = json_decode($request->getContent(), true);
        if(!$array){
            return new JsonResponse('error');
        }
        $repositoryGrp = $this->getDoctrine()->getRepository(EventGrp::class);
        $repositoryChat = $this->getDoctrine()->getRepository(ChatMsg::class);
        $grpId = $repositoryGrp->findOneBy(['name' => $array['name'], 'id_event' => $array['id_event']]);
        
        $newMsg = new ChatMsg();
        $newMsg -> setName($array['name']);
        $newMsg -> setContent($array['content']);
        $newMsg -> setIdGrp($grpId->getIdGrp());
        
        $entityManager->persist($newMsg);
        $entityManager->flush();

        return new JsonResponse('send');
    }

    /**
     * @Route("/user/getmsg", name="get_msg", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getMsg(Request $request, EntityManagerInterface $entityManager){
        $array = [];
        $array = json_decode($request->getContent(), true);
        if(!$array){
            return new JsonResponse('error');
        }
        $repositoryGrp = $this->getDoctrine()->getRepository(EventGrp::class);
        $repositoryChat = $this->getDoctrine()->getRepository(ChatMsg::class);
        $grpId = $repositoryGrp->findOneBy(['name' => $array['name'], 'id_event' => $array['id_event']]);
        $id = $grpId->getIdGrp();
        $chatmsg = $repositoryChat->findBy(['idGrp' => $id]);
        if(!$chatmsg){
            return new JsonResponse('no_msg');
        }
        $array1 = [];
        foreach($chatmsg as $msg){
            $array1[] = $msg->toArray();
        }
        

        return new JsonResponse($array1);
    }

}
