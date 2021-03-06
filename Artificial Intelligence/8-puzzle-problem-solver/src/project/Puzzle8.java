/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package reem;

import java.util.Arrays;
import java.util.Collections;
import java.util.HashMap;
import java.util.LinkedList;
import java.util.List;
import java.util.Map;
import java.util.Queue;

/**
 *
 * @author masi-
 */
public class Puzzle8 {
    final static String GOAL_PUZZLE ="123456780";
    List<String> agenda = new LinkedList <String>();    // Use of List Implemented using LinkedList for Storing All the Nodes .
    //visited Node
    Map<String,Integer> stateDepth = new HashMap <String, Integer>(); // HashMap is used to ignore repeated nodes
    //History of Nodes
    Map<String,String> stateHistory = new HashMap <String,String>(); // relates each position to its predecessor
    public int Cost_H1=0;
    public int Cost_H2=0;
    public long startTime;
    private String currentState;
    
     //Add method to add the new string to the Map and Queue
    void add(String newState, String oldState){
        if(!stateDepth.containsKey(newState)){
            int newValue = oldState == null ? 0 : stateDepth.get(oldState) + 1;
            stateDepth.put(newState,newValue);
            agenda.add(newState);
            stateHistory.put(newState, oldState);
        }
    }

    /* Each of the Methods below Takes the Current State of Board as String. Then the operation to move the blank space is done if possible.
      After that the new string is added to the map and queue.If it is the Goal State then the Program Terminates.
     */
    void up(String currentState){
        int a = currentState.indexOf("0");
        if(a>2){
            String nextState = currentState.substring(0,a-3)+"0"+currentState.substring(a-2,a)+currentState.charAt(a-3)+currentState.substring(a+1);
            checkCompletion(currentState, nextState);
        }
    }
    void down(String currentState){
        int a = currentState.indexOf("0");
        if(a<6){
            String nextState = currentState.substring(0,a)+currentState.substring(a+3,a+4)+currentState.substring(a+1,a+3)+"0"+currentState.substring(a+4);
            checkCompletion(currentState, nextState);
           }
    } 
    void left(String currentState){
        int a = currentState.indexOf("0");
        if(a!=0 && a!=3 && a!=6){
            String nextState = currentState.substring(0,a-1)+"0"+currentState.charAt(a-1)+currentState.substring(a+1);
            checkCompletion(currentState, nextState);
        }
    }
    void right(String currentState){
        int a = currentState.indexOf("0");
        if(a!=2 && a!=5 && a!=8){
            String nextState = currentState.substring(0,a)+currentState.charAt(a+1)+"0"+currentState.substring(a+2);
            checkCompletion(currentState, nextState);
        }
    }
    public boolean checkCompletion(String oldState, String newState) {
        add(newState, oldState);
        if(newState.equals(GOAL_PUZZLE)) {
            System.out.println("Solution Exists at Level "+stateDepth.get(newState)+" of the tree");
            String traceState = newState;
            while (traceState != null) {
                System.out.println(traceState + " at " + stateDepth.get(traceState));
                traceState = stateHistory.get(traceState);
            }
            
            long endTime = System.nanoTime();
            System.out.println("Execution Time:" +(endTime - startTime));
            System.out.println("Num of expanded node:"+stateHistory.size());
            System.exit(0);
            return true;
        }
        return false;
    }
 
 public void setState(String currentState){
     this.currentState=currentState;
 }
 
     public String getState() {
        return currentState;
    }
     
     public void setCost1(int cost){
     this.Cost_H1=cost;
 }
 
     public int getCost1() {
        return this.Cost_H1;
    }
     
     public void setCost2(int cost){
     this.Cost_H2=cost;
 }
 
     public int getCost2() {
        return this.Cost_H2;
    }
}
