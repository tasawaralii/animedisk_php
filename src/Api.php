<?php
class Api
{
    private function getPopular($interval)
    {
        $time = "";

        if ($interval == 1) {
            $time = "today";
        } else if ($interval == 7) {
            $time = "week";
        } else if ($interval == 30) {
            $time = "month";
        }

        // Ensure cache directory exists
        $cacheDir = __DIR__ . '/../data';
        if (!is_dir($cacheDir)) {
            @mkdir($cacheDir, 0777, true);
        }

        // Guard against invalid interval
        if ($time === '') {
            return [];
        }

        $dataPath = $cacheDir . "/$time.json";

        if (file_exists($dataPath)) {
            $data = json_decode(file_get_contents($dataPath), true);
            if ($data['date'] == date("Y-m-d")) {
                return $data['data'];
            }
        }

        $url = API_DOMAIN . "/api/anime/listanime.php?sort=$time&limit=10&key=deadtoonszylith";

        $data = @file_get_contents($url);
        if ($data !== false) {
            $data = json_decode($data, true);
            $store = [];
            $store['date'] = date("Y-m-d");
            $store['data'] = $data;
            file_put_contents($dataPath, json_encode($store));
            return $data;
        }
        return [];
    }

    public function popularToday(): array
    {
        return $this->getPopular(1);
    }
    public function popularWeek(): array
    {
        return $this->getPopular(7);
    }
    public function popularMonth(): array
    {
        return $this->getPopular(30);
    }
}