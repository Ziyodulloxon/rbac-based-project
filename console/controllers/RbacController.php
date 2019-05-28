<?php


namespace console\controllers;


use common\models\User;
use console\rbac\HasCompanyRule;
use console\rbac\OwnCompanyRule;
use console\rbac\OwnJobRule;
use console\rbac\OwnPersonProfileRule;
use console\rbac\OwnPersonRule;
use console\rbac\OwnProfileRule;
use Yii;
use yii\base\Exception;
use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * @throws \Exception
     * @throws Exception
     * */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        //Creating Roles
        $admin = $auth->createRole(User::ROLE_ADMIN);
        $admin->description = "Site administrator";
        $auth->add($admin);

        $partner = $auth->createRole(User::ROLE_PARTNER);
        $partner->description = "Partner company";
        $auth->add($partner);

        $person = $auth->createRole(User::ROLE_PERSON);
        $person->description = "Person of partner company";
        $auth->add($person);



        //Creating rules
        $ownPersonRule = new OwnPersonRule();
        $auth->add($ownPersonRule);

        $ownProfileRule = new OwnProfileRule();
        $auth->add($ownProfileRule);

        $ownCompanyRule = new OwnCompanyRule();
        $auth->add($ownCompanyRule);

        $ownPersonProfileRule = new OwnPersonProfileRule();
        $auth->add($ownPersonProfileRule);

        $ownJobRule = new OwnJobRule();
        $auth->add($ownJobRule);



        //Creating Permissions
        $indexPartner = $auth->createPermission('indexPartner');
        $indexPartner->description = "Manage a partner";
        $auth->add($indexPartner);

        $viewPartner = $auth->createPermission('viewPartner');
        $viewPartner->description = "View a partner";
        $auth->add($viewPartner);

        $updatePartner = $auth->createPermission('updatePartner');
        $updatePartner->description = "Update a partner";
        $auth->add($updatePartner);

        $createPartner = $auth->createPermission('createPartner');
        $createPartner->description = "Update a partner";
        $auth->add($createPartner);

        $deletePartner = $auth->createPermission('deletePartner');
        $deletePartner->description = "Update a partner";
        $auth->add($deletePartner);

//        $updateOwnCompany = $auth->createPermission('updateOwnCompany');
//        $updateOwnCompany->description = "Update own company";
//        $updateOwnCompany->ruleName = $ownCompanyRule->name;
//        $auth->add($updateOwnCompany);

        $viewOwnCompany = $auth->createPermission('viewOwnCompany');
        $viewOwnCompany->description = "View own company";
        $viewOwnCompany->ruleName = $ownCompanyRule->name;
        $auth->add($viewOwnCompany);

        $viewOwnJob = $auth->createPermission('viewOwnJob');
        $viewOwnJob->description = "View own company";
        $viewOwnJob->ruleName = $ownJobRule->name;
        $auth->add($viewOwnJob);

//        $auth->addChild($updateOwnCompany, $updatePartner);
        $auth->addChild($viewOwnCompany, $viewPartner);
        $auth->addChild($viewOwnJob, $viewPartner);

        $auth->addChild($admin, $indexPartner);
        $auth->addChild($admin, $viewPartner);
        $auth->addChild($admin, $createPartner);
        $auth->addChild($admin, $deletePartner);
        $auth->addChild($admin, $updatePartner);
//        $auth->addChild($partner, $updateOwnCompany);
        $auth->addChild($partner, $viewOwnCompany);
        $auth->addChild($person, $viewOwnJob);



        $crudPerson = $auth->createPermission('crudPerson');
        $crudPerson->description = "Manage company person";
        $auth->add($crudPerson);

        $createPerson = $auth->createPermission('createPerson');
        $createPerson->description = "Manage company person";
        $auth->add($createPerson);

        $crudOwnPerson = $auth->createPermission('crudOwnPerson');
        $crudOwnPerson->description = "Manage company person";
        $crudOwnPerson->ruleName = $ownPersonRule->name;
        $auth->add($crudOwnPerson);

        $auth->addChild($crudOwnPerson, $crudPerson);

        $auth->addChild($admin, $crudPerson);
        $auth->addChild($partner, $createPerson);
        $auth->addChild($partner, $crudOwnPerson);


        $indexUser = $auth->createPermission('indexUser');
        $indexUser->description = "Crud users";
        $auth->add($indexUser);

        $viewUser = $auth->createPermission('viewUser');
        $viewUser->description = "View users profile";
        $auth->add($viewUser);

        $createUser = $auth->createPermission('createUser');
        $createUser->description = "View users profile";
        $auth->add($createUser);

        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = "View users profile";
        $auth->add($updateUser);

        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = "View users profile";
        $auth->add($deleteUser);

        $viewOwnPersonsProfile = $auth->createPermission('viewOwnPersonsProfile');
        $viewOwnPersonsProfile->description = "View own persons profile";
        $viewOwnPersonsProfile->ruleName = $ownPersonProfileRule->name;
        $auth->add($viewOwnPersonsProfile);

        $viewOwnProfile = $auth->createPermission('viewOwnProfile');
        $viewOwnProfile->description = "View own profile";
        $viewOwnProfile->ruleName = $ownProfileRule->name;
        $auth->add($viewOwnProfile);

        $auth->addChild($viewOwnProfile, $viewUser);
        $auth->addChild($viewOwnPersonsProfile, $viewUser);

        $auth->addChild($admin, $indexUser);
        $auth->addChild($admin, $viewUser);
        $auth->addChild($admin, $createUser);
        $auth->addChild($admin, $updateUser);
        $auth->addChild($admin, $deleteUser);
        $auth->addChild($person, $viewOwnProfile);
        $auth->addChild($partner, $viewOwnPersonsProfile);

        $auth->addChild($partner, $person);
        $auth->addChild($admin, $partner);

        //Assignment
        $auth->assign($admin, 1);
    }
}