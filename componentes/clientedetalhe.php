<?php

	class Clientedetalhe
	{
		public $link = "";
        public $codigocliente = "";
        public $cnpj = "";
        public $newsletter = "";
        public $created = "";
        public $terms = "";
        public $id = "";
        public $name = "";
        public $registration_date = "";
        public $rg = "";
        public $cpf = "";
        public $phone = "";
        public $cellphone = "";
        public $birth_date= "";
        public $gender = "";
        public $email = "";
        public $nickname = "";
        public $token = "";
        public $total_orders = "";
        public $observation = "";
        public $type = "";
        public $company_name = "";
        public $state_inscription = "";
        public $reseller = "";
        public $discount = "";
        public $blocked = "";
        public $credit_limit = "";
        public $indicator_id = "";
        public $profile_customer_id = "";
        public $last_sending_newsletter = "";
        public $last_purchase = "";
        public $last_visit = "";
        public $last_modification = "";
        public $address = "";
        public $zip_code = "";
        public $number = "";
        public $complement = "";
        public $neighborhood = "";
        public $city = "";
        public $state = ""; 
        public $country = "";
        public $modified = "";
        public $dtmodification = "";

		public function GetAll()
		{
			$qry = 	"
                        SELECT 	*
						FROM 	clientedetalhe cd
						WHERE 	1=1
					";
			//echo $qry;
			$result = mysqli_query($this->link,$qry);
			return $result;
		}


		public function insertClienteDetalhe()
		{
            $qry = "SELECT * FROM clientedetalhe WHERE codigocliente = '$this->codigocliente'";
            echo $qry;
            echo "<br><br>";
            $result = mysqli_query($this->link, $qry); 
            $resultline = mysqli_num_rows($result);

            if($resultline < 1){ 

                $qrys = "INSERT INTO clientedetalhe(codigocliente,
                cnpj,
                newsletter,
                created,
                terms,
                id, 
                namecliente,
                registration_date,
                rg,
                cpf,
                phone,
                cellphone,
                birth_date,
                gender,
                email,
                nickname,
                token,
                total_orders,
                observation,
                typecliente,
                company_name,
                state_inscription,
                reseller,
                discount,
                blocked,
                credit_limit,
                indicator_id,
                profile_customer_id,
                last_sending_newsletter,
                last_purchase,
                last_visit,
                last_modification,
                addresscliente,
                zip_code,
                numbercliente,
                complement,
                neighborhood,
                city,
                statecliente,
                country,
                modified)
                VALUES ( '$this->codigocliente', '$this->cnpj',
                '$this->newsletter',
                '$this->created',
                '$this->terms',
                '$this->id',
                '$this->name',
                '$this->registration_date',
                '$this->rg',
                '$this->cpf',
                '$this->phone',
                '$this->cellphone',
                '$this->birth_date',
                '$this->gender',
                '$this->email',
                '$this->nickname',
                '$this->token',
                '$this->total_orders',
                '$this->observation',
                '$this->type',
                '$this->company_name',
                '$this->state_inscription',
                '$this->reseller',
                '$this->discount',
                '$this->blocked',
                '$this->credit_limit',
                '$this->indicator_id',
                '$this->profile_customer_id',
                '$this->last_sending_newsletter',
                '$this->last_purchase',
                '$this->last_visit',
                '$this->last_modification',
                '$this->address',
                '$this->zip_code',
                '$this->number',
                '$this->complement',
                '$this->neighborhood',
                '$this->city',
                '$this->state', 
                '$this->country',
                '$this->modified');";
                mysqli_query($this->link, $qrys);   
                print_r($qrys); 
                echo "<br><br>";
			}else{
                $qry = "UPDATE clientedetalhe SET codigocliente = '$this->codigocliente',
                cnpj = '$this->cnpj',
                newsletter = '$this->newsletter',
                created = '$this->created',
                terms = '$this->terms',
                id = '$this->id',
                namecliente = '$this->name',
                registration_date = '$this->registration_date',
                rg = '$this->rg',
                cpf = '$this->cpf',
                phone = '$this->phone',
                cellphone = '$this->cellphone',
                birth_date = '$this->birth_date',
                gender = '$this->gender',
                email ='$this->email',
                nickname ='$this->nickname',
                token = '$this->token',
                total_orders = '$this->total_orders',
                observation = '$this->observation',
                typecliente = '$this->type',
                company_name = '$this->company_name',
                state_inscription = '$this->state_inscription',
                reseller = '$this->reseller',
                discount = '$this->discount',
                blocked = '$this->blocked',
                credit_limit = '$this->credit_limit',
                indicator_id = '$this->indicator_id',
                profile_customer_id = '$this->profile_customer_id',
                last_sending_newsletter = '$this->last_sending_newsletter',
                last_purchase = '$this->last_purchase',
                last_visit = '$this->last_visit',
                last_modification = '$this->last_modification',
                addresscliente = '$this->address',
                zip_code = '$this->zip_code',
                numbercliente = '$this->number',
                complement = '$this->complement',
                neighborhood = '$this->neighborhood',
                city = '$this->city',
                statecliente = '$this->state',
                country = '$this->country',
                modified = '$this->modified'
                WHERE codigocliente = $this->codigocliente"; 

                $result = mysqli_query($this->link, $qry);
                echo $qry;
			} 
		}

		public function DadosCliente()
		{
			$au = $this->GetAll();
			while($du = mysqli_fetch_array($au,MYSQLI_ASSOC))
			{
                $this->cliente = $du["cliente"];
                $this->codigocliente = $du["codigocliente"];
                $this->cnpj = $du["cnpj"];
                $this->datacriacao = $du["datacriacao"];
                $this->dataregistro = $du["dataregistro"];
                $this->cpf = $du["cpf"];
                $this->datanascimento = $du["datanascimento"];
                $this->genero = $du["genero"];
                $this->email = $du["email"];
                $this->desconto = $du["desconto"];
                $this->ultimavisita = $du["ultimavisita"];
                $this->cidade = $du["cidade"];
                $this->uf = $du["uf"];
                $this->newsletter = $du["newsletter"];
                $this->datamodificacao = $du["datamodificacao"];
			}
		}
	}
?>