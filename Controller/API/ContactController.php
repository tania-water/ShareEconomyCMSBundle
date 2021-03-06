<?php

namespace Ibtikar\ShareEconomyCMSBundle\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Ibtikar\ShareEconomyCMSBundle\APIResponse as CMSApiResponse;
use Ibtikar\ShareEconomyCMSBundle\Entity\CmsContact;

class ContactController extends Controller
{

    /**
     * Get contact us types
     *
     * @ApiDoc(
     *  section="Contact",
     *  statusCodes={
     *      200="Returned on success",
     *      500="Returned if there is an internal server error"
     *  },
     *  responseMap = {
     *      200="Ibtikar\ShareEconomyCMSBundle\APIResponse\ContactTypesResponse",
     *      500="Ibtikar\ShareEconomyToolsBundle\APIResponse\InternalServerError"
     *  }
     * )
     * @author Karim Shendy <kareem.elshendy@ibtikar.net.sa>
     * @return JsonResponse
     */
    public function contactTypesAction(Request $request)
    {
        $em           = $this->getDoctrine()->getManager();
        $contactTypes = $em->getRepository('IbtikarShareEconomyCMSBundle:CmsContactType')->findAll();

        $responseObject = new CMSApiResponse\ContactTypesResponse();

        if (count($contactTypes)) {
            foreach ($contactTypes as $type) {
                $responseObject->items[] = [
                    'id'   => $type->getId(),
                    'name' => $type->getTitle($request->getLocale())
                ];
            }
        }

        return new JsonResponse($responseObject);
    }

    /**
     * contact us
     *
     * @ApiDoc(
     *  description="Contact us",
     *  section="Contact",
     *  parameters={
     *      {"name"="title", "dataType"="string", "required"=true},
     *      {"name"="description", "dataType"="string", "required"=true},
     *      {"name"="type", "dataType"="integer", "required"=true}
     *  },
     *  statusCodes = {
     *      200 = "Returned on success",
     *      400 = "Validation failed.",
     *      500 = "Returned if there is an internal server error"
     *  },
     *  responseMap = {
     *      200 = "Ibtikar\ShareEconomyCMSBundle\APIResponse\MainResponse",
     *      400 = "Ibtikar\ShareEconomyCMSBundle\APIResponse\ValidationErrorsResponse",
     *      500 = "Ibtikar\ShareEconomyToolsBundle\APIResponse\InternalServerError"
     *  }
     * )
     *
     * @param Request $request
     * @author Karim Shendy <kareem.elshendy@ibtikar.net.sa>
     * @return JsonResponse
     */
    public function contactUsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /* @var $translator \Symfony\Component\Translation\DataCollectorTranslator */
        $translator = $this->get('translator');

        $contact = new CmsContact();
        $contact->setTitle(trim($request->get('title')));
        $contact->setDescription(trim($request->get('description')));
        $user = $this->getUser();
        if ($user) {
            $contact->setUser($user);
        } else {
            $validateUserExist = $this->getParameter('ibtikar_share_economy_cms.requireLoggedInUser');
            if ($validateUserExist) {
                $output = new CMSApiResponse\MainResponse();
                $output->status = false;
                $output->code = 401;
                $output->message = $translator->trans('Invalid credentials');
                return new JsonResponse($output);
            }
        }

        if ("" !== trim($request->get('type'))) {
            $type = $em->getRepository('IbtikarShareEconomyCMSBundle:CmsContactType')->find(trim($request->get('type')));

            if (!$type) {
                $errorMsg = $translator->trans('Type not exist.', array(), 'contactus');
                $errorResponse = new CMSApiResponse\ValidationErrorsResponse();
                $errorResponse->errors = array('type' => $errorMsg);
                return new JsonResponse($errorResponse);
            }
            $contact->setType($type);
        }

        $validationMessages = [];
        $errors             = $this->get('validator')->validate($contact);

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $validationMessages[$error->getPropertyPath()] = $error->getMessage();
            }
        }

        if (count($validationMessages)) {
            $output         = new CMSApiResponse\ValidationErrorsResponse();
            $output->errors = $validationMessages;
        } else {
            $em->persist($contact);

            try {
                $em->flush();
                $output = new CMSApiResponse\MainResponse();
                $output->message = $translator->trans('Success.');
            } catch (\Exception $exc) {
                $this->get('logger')->critical($exc->getMessage());
                $output          = new CMSApiResponse\MainResponse();
                $output->status  = false;
                $output->code    = 500;
                $output->message = $this->get('translator')->trans("something_went_wrong");
            }
        }

        return new JsonResponse($output);
    }
}