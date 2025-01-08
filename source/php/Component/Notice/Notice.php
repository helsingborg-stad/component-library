<?php

namespace ComponentLibrary\Component\Notice;

class Notice extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if (empty($id)) {
            $this->data['id'] = uniqid();
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
        $action = array_merge(['label' => null, 'url' => null], (array) $action);
        if (empty(array_filter($this->data['action']))) {
            $action = false;
        }
        return $action;
    }
}
