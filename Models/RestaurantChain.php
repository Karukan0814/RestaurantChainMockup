<?php

namespace Models;

use Interfaces\FileConvertible;
use Models\Company;
use Models\RestaurantLocation;

class RestaurantChain extends Company  implements FileConvertible
{


    protected int $chainID; //チェーン ID（int）: レストランチェーンの一意の識別子
    protected array $restaurantLocations; //レストランの場所（array）: レストランチェーンの異なる場所を表す RestaurantLocation オブジェクトの配列
    protected string $cuisineType; //料理の種類（string）: レストランチェーンで提供される料理の種類
    protected int $numberOfLocations; //場所の総数（int）: チェーン内のレストランの総数
    protected int  $isDriveThrough; // ドライブスルーの有無（bool）: チェーンのレストランにドライブスルーがあるかどうかを示します
    protected int  $chainFoundingYear; // 設立年（int）: レストランチェーンが設立された年
    protected string $parentCompany; // 親会社（string）: 親会社の名前（該当する場合）

    protected string $locationNamesString;




    public function __construct(
        // string $name,
        // int $foundingYear,
        // string $description,
        // string $website,
        // string $phone,
        // string $industry,
        // string $ceo,
        // bool $isPubliclyTraded,
        // string $country,
        // string $founder,
        // int $totalEmployees,
        Company $parentCompany,

        int $chainID,
        array $restaurantLocations,
        string $cuisineType,
        int $numberOfLocations,
        int  $isDriveThrough,
        int  $chainFoundingYear,
        // string $parentCompany,

    ) {

        $parentCompanyInfo = $parentCompany->toArray();
        parent::__construct(
            $parentCompanyInfo["name"],
            $parentCompanyInfo["foundingYear"],
            $parentCompanyInfo["description"],
            $parentCompanyInfo["website"],
            $parentCompanyInfo["phone"],
            $parentCompanyInfo["industry"],
            $parentCompanyInfo["ceo"],
            $parentCompanyInfo["isPubliclyTraded"],
            $parentCompanyInfo["country"],
            $parentCompanyInfo["founder"],
            $parentCompanyInfo["totalEmployees"],

        );
        $this->chainID = $chainID;
        $this->restaurantLocations = $restaurantLocations;
        $this->cuisineType = $cuisineType;
        $this->numberOfLocations = $numberOfLocations;
        $this->isDriveThrough = $isDriveThrough;
        $this->chainFoundingYear = $chainFoundingYear;
        $this->parentCompany = $parentCompanyInfo["name"];

        $locationNames = array_map(function ($location) {
            $propertyMap = $location->toArray();
            return $propertyMap["name"];
        }, $this->restaurantLocations);
        $locationNamesString = implode(', ', $locationNames);
        $this->locationNamesString = $locationNamesString;
    }





    public function toString(): string
    {
        $parentString = parent::toString();



        return $parentString . sprintf(
            "chainID: %d\nrestaurantLocations: %s\nCuisine Type: %s\nNumber of Locations: %d\nisDriveThrough: %s\nchainFoundingYear: %d\nparentCompany: %s\n",
            $this->chainID,
            $this->locationNamesString,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->isDriveThrough ? "True" : "False",
            $this->chainFoundingYear,
            $this->parentCompany,


        );
    }

    public function toHTML()
    {
        $parentHTML = parent::toHTML();
        return

            $parentHTML . sprintf(
                "
            <div class='company-card'>
                <p>chainID: %d</p>
                <p>Location List: %s</p>
                <p>Cuisine Type: %s</p>
                <p>Number of Locations: %d</p>
                <p>isDriveThrough: %s</p>
                <p>chainFoundingYear: %d</p>
                <p>parentCompany: %s</p>  

            </div>",
                $this->chainID,
                $this->locationNamesString,
                $this->cuisineType,
                $this->numberOfLocations,
                $this->isDriveThrough ? "True" : "False",
                $this->chainFoundingYear,
                $this->parentCompany,
            );
    }

    public function toMarkdown()
    {
        $parentMarkdown = parent::toMarkdown();
        return $parentMarkdown . sprintf(
            "
                 - chainID: %d
                 - Location List: %s
                 - Cuisine Type: %s
                 - Number of Locations: %d
                 - isDriveThrough: %s
                 - chainFoundingYear: %d
                 - parentCompany: %s",
            $this->chainID,
            $this->locationNamesString,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->isDriveThrough ? "True" : "False",
            $this->chainFoundingYear,
            $this->parentCompany,
        );
    }

    public function toArray()
    {
        $parentArray = parent::toArray();
        return array_merge($parentArray, [
            'chainID' => $this->chainID,
            'restaurantLocations' => $this->restaurantLocations,
            'type' => $this->cuisineType,
            'numberOfLocations' => $this->numberOfLocations,
            'isDriveThrough' => $this->isDriveThrough,
            'chainFoundingYear' => $this->chainFoundingYear,

            'parentCompany' => $this->parentCompany


        ]);
    }

    // チェーンに新しいレストランの場所を追加するメソッド
    public function addNewLocation(RestaurantLocation $newLocation)
    {
        $this->restaurantLocations[] = $newLocation;
    }
}
