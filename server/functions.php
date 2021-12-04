<?php
    function getBindingString($args) {
        $string = "";
        foreach($args as $a) {
            if(is_int($a)) {
                $string .= "i";
            } else if (is_double($a)) {
                $string .= "d";
            } else {
                $string .= "s";
            }
        }
        return $string;
    }
    /*
     * This function executes the query and return the statement object
     */
    function query_execution($db, $query, $params) {
        $statement = $db->prepare($query);
        $statement->bind_param(getBindingString($params), ...$params);
        $statement->execute();
        return $statement;
    }
    /*
     * Returns query recors
     */
    function statement_records($statement) {
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    /*
     * Return if the query was correctly executed
     */
    function statement_success($statement) {
        return !$statement->error;
    }
    /*
     * Types of query
     */
    function select_query($db, $query, $params) {
        return statement_records(query_execution($db, $query, $params));
    }

    function insert_query($db, $query, $params) {
        return statement_success(query_execution($db, $query, $params));
    }

    function update_query($db, $query, $params) {
        return statement_success(query_execution($db, $query, $params));
    }

    function delete_query($db, $query, $params) {
        return statement_success(query_execution($db, $query, $params));
    }
    /*
     * This function executes the given query and return records if it selection
     * or a boolean in any other case 
     */
    function execute_query($db, $query, $params) {
        switch(strtolower(substr($query, 0, 1))) {
            case "s":
                return select_query($db, $query, $params);
                break;
            case "i":
            case "u":
            case "d":
                return statement_success(query_execution($db, $query, $params));
                break;
            default:
                return false;
                break;
        }
    }
?>