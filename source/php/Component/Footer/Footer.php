<?php

namespace ComponentLibrary\Component\Footer;

class Footer extends \ComponentLibrary\Component\BaseController implements FooterInterface  
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['links'] = $this->addTargetToLinks($links);

        if (!isset($this->data['logotypeHref'])) {
            $this->data['logotypeHref'] = "/";
        }

        if (isset($subfooter['flexDirection'])) {
            $direction = $subfooter['flexDirection'] == 'row' ? 'horizontal' : 'vertical';
            $this->data['directionClass'] = $this->getBaseClass() . '__subfooter--' . $direction;
        }

        if (isset($subfooter['alignment'])) {
            $alignment = $subfooter['alignment'] ?? 'flex-start';
            $this->data['alignmentClass'] = $this->getBaseClass() . '__subfooter--align-' . $alignment;
        }

        $this->data['displaySubFooter'] = $this->displaySubFooter(
            $subfooterLogotype ?? false,
            $subfooter['content'] ?? false
        );
    }

    /**
     * Toggle display of subfooter
     *
     * @param string $logotype
     * @param array $content
     * @return bool
     */
    private function displaySubFooter($logotype, $content): bool
    {
        if (!$logotype && empty($content)) {
            return false;
        }
        return true;
    }

    protected function addTargetToLinks($arr)
    {
        foreach($arr as $key => $data) {
            if(array_key_exists('href', $data) && !array_key_exists('target', $data)) {
                $arr[$key]['target'] = '_self';
            }

            if(!array_key_exists('href', $data)) {
                $arr[$key] = $this->addTargetToLinks($data);
            }
        }
        return $arr;
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'footer';
    }

    // -------------------------------------------------------------------------
    // FooterInterface — generated getters
    // -------------------------------------------------------------------------

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'footer';
    }

    public function getSlotOnly(): bool
    {
        return $this->data['slotOnly'] ?? false;
    }

    public function getId(): string
    {
        return $this->data['id'] ?? null;
    }

    public function getLogotype(): string
    {
        return $this->data['logotype'] ?? '/';
    }

    public function getLogotypeHref(): string
    {
        return $this->data['logotypeHref'] ?? '';
    }

    public function getLinks(): array
    {
        return $this->data['links'] ?? [];
    }

    public function getSubfooterLogotype(): string
    {
        return $this->data['subfooterLogotype'] ?? '';
    }

    public function getPrefooter(): string
    {
        return $this->data['prefooter'] ?? null;
    }

    public function getPostfooter(): string
    {
        return $this->data['postfooter'] ?? null;
    }

    public function getFooterareas(): string
    {
        return $this->data['footerareas'] ?? null;
    }
}
