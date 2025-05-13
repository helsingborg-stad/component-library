<?php

namespace ComponentLibrary\Component\Notice;

class Notice extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        // Backwards compatibility
        $data['action']['text'] ??= ($data['action']['label'] ?? '');

        if (empty($id)) {
            $this->data['id'] = $this->sanitizeIdAttribute(uniqid());
        }

        // TODO: Find instances of this and 
        if (!empty($icon['name'])) {
            $icon['icon'] = $icon['name'];
        }
     
        // State class
        if (in_array($type, ['success', 'warning', 'danger', 'info'])) {
            $this->data['classList'][] = $this->getBaseClass() . "--" . $type;
        } else {
            $this->data['classList'][] = $this->getBaseClass() . "--info";
        }

        //Take up full width
        if ($stretch) {
            $this->data['classList'][] = $this->getBaseClass() . "--stretch";
        }

        // Information
        $this->data['message']  = $this->handleMessageData($message);

        // Action
        $this->data['action']   = $this->handleActionData($action);
        if (isset($this->data['action']['position']) && $this->data['action']['position'] === 'below') {
            $this->data['classList'][] = $this->getBaseClass() . "--action-below";
        }

        // Dismissable signature
        if ($dismissable) {
            //Set a dismissable attribute
            $this->data['attributeList']['data-dismissable-notice'] = true;

            //Add signature to attribute list
            $hashBase = $this->createDismissableSignature($this->data);
            $this->data['attributeList'][
                'data-dismissable-notice-uid'
            ] = md5(serialize($hashBase));

            //Add dismussed time period to attribute list
            $timeout = in_array($dismissable, [
                'immediate', 'session', 'permanent'
            ], true) ? $dismissable : 'session';
            $this->data['attributeList'][
                'data-dismissable-notice-timeout'
            ] = $timeout ?? 0;
        }
    }

    private function createDismissableSignature($data)
    {
        $hashBase = [
            $data['message'] ?? '',
            $data['action']['text'] ?? '',
            $data['action']['url'] ?? '',
            $data['action']['position'] ?? '',
        ];
        return md5(serialize($hashBase));
    }

    /**
     * Handle message data, make 
     * arrays conform to base format.
     *
     * @param array $message
     * @return array
     */
    private function handleMessageData($message): array
    {
        return array_merge(['title' => null, 'message' => null], (array) $message);
    }

    /**
     * Handle action data, makes non empty 
     * arrays conform to base format.
     * Empty arrays are converted to null.
     *
     * @param array $action
     * @return array|null
     */
    private function handleActionData($action): ?array
    {
        $action = array_merge(['text' => null, 'url' => null, 'position' => null], (array) $action);
        if (empty(array_filter($this->data['action'] ?: []))) {
            $action = null;
        }
        return $action;
    }
}
