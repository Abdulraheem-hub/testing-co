<?php

use Symfony\Contracts\Translation\TranslatorInterface;

class CustomerFormatter extends CustomerFormatterCore
{
    private $translator;
    private $language;

    private $ask_for_birthdate = true;
    private $ask_for_partner_optin = true;
    private $partner_optin_is_required = true;
    private $ask_for_password = true;
    private $password_is_required = true;
    private $ask_for_new_password = false;

    public function __construct(
        TranslatorInterface $translator,
        Language $language
    ) {
        parent::__construct(
            $translator,
            $language
        );
        $this->translator = $translator;
        $this->language = $language;
    }

    public function setAskForBirthdate($ask_for_birthdate)
    {
        $this->ask_for_birthdate = $ask_for_birthdate;

        return $this;
    }

    public function setAskForPartnerOptin($ask_for_partner_optin)
    {
        $this->ask_for_partner_optin = $ask_for_partner_optin;

        return $this;
    }

    public function setPartnerOptinRequired($partner_optin_is_required)
    {
        $this->partner_optin_is_required = $partner_optin_is_required;

        return $this;
    }

    public function setAskForPassword($ask_for_password)
    {
        $this->ask_for_password = $ask_for_password;

        return $this;
    }

    public function setAskForNewPassword($ask_for_new_password)
    {
        $this->ask_for_new_password = $ask_for_new_password;

        return $this;
    }

    public function setPasswordRequired($password_is_required)
    {
        $this->password_is_required = $password_is_required;

        return $this;
    }





		





    public function getFormat()
    {
        $format = [];

        

        $format['firstname'] = (new FormField())
            ->setName('firstname')
            ->setLabel(
                $this->translator->trans(
                    'First name',
                    [],
                    'Shop.Forms.Labels'
                )
            )
            ->setRequired(true)
            ->addAvailableValue(
                'comment',
                $this->translator->trans('Only letters and the dot (.) character, followed by a space, are allowed.', [], 'Shop.Forms.Help')
            );

        $format['lastname'] = (new FormField())
            ->setName('lastname')
            ->setLabel(
                $this->translator->trans(
                    'Last name',
                    [],
                    'Shop.Forms.Labels'
                )
            )
            ->setRequired(true)
            ->addAvailableValue(
                'comment',
                $this->translator->trans('Only letters and the dot (.) character, followed by a space, are allowed.', [], 'Shop.Forms.Help')
            );
            
        $format['phone'] = (new FormField())
            ->setName('phone')
            ->setType('tel')
            ->setRequired(true)
            ->setLabel('Phone Number');
		
		
    

        $format['email'] = (new FormField())
            ->setName('email')
            ->setType('email')
            ->setLabel(
                $this->translator->trans(
                    'Email',
                    [],
                    'Shop.Forms.Labels'
                )
            )
            ->setRequired(true);

        if ($this->ask_for_password) {
            $format['password'] = (new FormField())
                ->setName('password')
                ->setType('password')
                ->setLabel(
                    $this->translator->trans(
                        'Password',
                        [],
                        'Shop.Forms.Labels'
                    )
                )
                ->setRequired($this->password_is_required);
        }

        if ($this->ask_for_new_password) {
            $format['new_password'] = (new FormField())
                ->setName('new_password')
                ->setType('password')
                ->setLabel(
                    $this->translator->trans(
                        'New password',
                        [],
                        'Shop.Forms.Labels'
                    )
                );
        }

        
        
        $additionalCustomerFormFields = Hook::exec('additionalCustomerFormFields', ['fields' => &$format], null, true);

        if (is_array($additionalCustomerFormFields)) {
            foreach ($additionalCustomerFormFields as $moduleName => $additionnalFormFields) {
                if (!is_array($additionnalFormFields)) {
                    continue;
                }

                foreach ($additionnalFormFields as $formField) {
                    $formField->moduleName = $moduleName;
                    $format[$moduleName . '_' . $formField->getName()] = $formField;
                }
            }
        }


        return $this->addConstraints($format);
    }

    private function addConstraints(array $format)
    {
        $constraints = Customer::$definition['fields'];

        foreach ($format as $field) {
            if (!empty($constraints[$field->getName()]['validate'])) {
                $field->addConstraint(
                    $constraints[$field->getName()]['validate']
                );
            }
        }

        return $format;
    }

}
