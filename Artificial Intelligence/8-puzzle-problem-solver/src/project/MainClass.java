/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package reem;

import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.HashMap;
import java.util.HashSet;
import java.util.LinkedList;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;
import java.util.PriorityQueue;
import java.util.Queue;
import java.util.Scanner;
import java.util.Set;
import java.util.Stack;
import java.util.concurrent.LinkedBlockingDeque;

/**
 *
 * @author masi-
 */
public class MainClass {

    /**
     * @param args the command line arguments
     */
    static Node Start_puzzle;
    
    public static void UserChoise(){
        Scanner input = new Scanner(System.in);
         int choice;
         boolean userchois=true;
    while(userchois){
        System.out.println("Enter Your Choise");
        System.out.println("1.) DFS ");
        System.out.println("2.) BFS");
        System.out.println("3.) Greedy");
        System.out.println("4.) A*");
        System.out.println("Enter Your Menu Choice: ");
        choice = input.nextInt();
        switch(choice){
            case 1:
               if(!Start_puzzle.getState().isEmpty()){
                   
                   DFS(Start_puzzle.getState());
               }
                userchois=false;
                break;
            case 2:
                if(!Start_puzzle.getState().isEmpty())
                {
                       // stateSet is a set that contains node that are already visited
                   
                     BFS(Start_puzzle.getState());
                   
                }
                userchois=false;
                break;
            case 3: 
              if(!Start_puzzle.getState().isEmpty())
                {
                    
                    Greedy(Start_puzzle.getState(),Heuristic.H_ONE);
                    Greedy(Start_puzzle.getState(),Heuristic.H_TWO);
                }
              else{
                   System.out.println("Please Enter Puzzle");
                   System.exit(0);
              }
                userchois=false;
                break;
            case 4:
              if(!Start_puzzle.getState().isEmpty())
              {
                  aStar(Start_puzzle.getState(), Heuristic.H_ONE);
                  aStar(Start_puzzle.getState(), Heuristic.H_TWO);
              }
                userchois=false;
                break;
        }
    }
    }
    
    public static void ReadPuzzel() throws FileNotFoundException, IOException{
       StringBuilder p = new StringBuilder();
       FileReader reader = new FileReader("C:\\Users\\Toshiba\\Desktop\\AI project\\Reem\\Puzzle8.txt");
       System.out.println("------------Read Puzzle From File-------------");   
       Scanner scanner = new Scanner(reader);
       
       for(int i=0;i<3;i++){
           for(int j=0;j<3;j++){
               p.append(scanner.next());
           }
       }       
       Start_puzzle= new Node(p.toString());
        System.out.println("----------------Orginal Puzzle---------------");
        System.out.println(Start_puzzle.getState().toString());
    }
    
    public static void BFS(String start){ 
      // stateSet is a set that contains node that are already visited
        Set<String> stateSets = new HashSet<String>();
        int totalCost = 0;
        int time = 0;
        Node node = new Node(start);
        Queue<Node> queue = new LinkedList<Node>();
        Node currentNode = node;
        while (!currentNode.getState().equals(Puzzle8.GOAL_PUZZLE)) {
            stateSets.add(currentNode.getState());
            List<String> nodeSuccessors = Node.getSuccessors(currentNode.getState());
            for (String n : nodeSuccessors) {
                if (stateSets.contains(n))
                    continue;
                stateSets.add(n);
                Node child = new Node(n);
                currentNode.addChild(child);
                child.setParent(currentNode);
                queue.add(child);

            }
            currentNode = queue.poll();
            time += 1;
        }

        Node.printSolution(currentNode, stateSets, node, time);

    }
    
    public static void DFS(String str){
     // stateSet is a set that contains node that are already visited
        Set<String> stateSets = new HashSet<String>();
        int totalCost = 0;
        int time = 0;
        Node node = new Node(str);
        //the queue that store nodes that we should expand
        Queue<Node> mainQueue = new LinkedList<>();
        //the queue that contains the successors of the expanded node
        Queue<Node> successorsQueue = new LinkedList<>();
        Node currentNode = node;
        while (!currentNode.getState().equals(Puzzle8.GOAL_PUZZLE)) {
            stateSets.add(currentNode.getState());
            List<String> nodeSuccessors = Node.getSuccessors(currentNode.getState());
            for (String n : nodeSuccessors) {
                if (stateSets.contains(n))
                    continue;
                stateSets.add(n);
                Node child = new Node(n);
                currentNode.addChild(child);
                child.setParent(currentNode);
                successorsQueue.add(child);
            }
            //we add the queue that contains the successors of the visted node to the beginning of the main queue
            mainQueue.addAll(successorsQueue);
            //successors queue should be cleared in order to store the next expaneded's successors
            successorsQueue.clear();
            currentNode = mainQueue.poll();
            time += 1;
            nodeSuccessors.clear();
        }
        Node.printSolution(currentNode, stateSets, node, time);
    }
    
   public static void aStar(String str,Heuristic heuristic) {
        // stateSet is a set that contains node that are already visited
        Set<String> stateSets = new HashSet<String>();
        int time = 0;
        Node node = new Node(str);
        node.setTotalCost(0);
       

        // a queue that contains nodes and their cost values sorted. 10 is the initial size
        PriorityQueue<Node> nodePriorityQueue = new PriorityQueue<Node>(10);
        Node currentNode = node;
        currentNode.startTime=System.nanoTime();
        while (!currentNode.getState().equals(Puzzle8.GOAL_PUZZLE)) {
            stateSets.add(currentNode.getState());
            List<String> nodeSuccessors = Node.getSuccessors(currentNode.getState());
            for (String n : nodeSuccessors) {
                if (stateSets.contains(n))
                    continue;
                stateSets.add(n);
                Node child = new Node(n);
                currentNode.addChild(child);
                child.setParent(currentNode);

                if (heuristic == Heuristic.H_ONE)
                    child.setTotalCost(currentNode.getTotalCost() + Character.getNumericValue(child.getState().charAt(child.getParent().getState().indexOf('0'))), heuristicOne(child.getState(), Puzzle8.GOAL_PUZZLE));
                else if (heuristic == Heuristic.H_TWO)
                    child.setTotalCost(currentNode.getTotalCost() + Character.getNumericValue(child.getState().charAt(child.getParent().getState().indexOf('0'))), heuristicTwo(child.getState(), Puzzle8.GOAL_PUZZLE));
               
                nodePriorityQueue.add(child);

            }
            currentNode = nodePriorityQueue.poll();
            time += 1;
        }
       Node.printSolution(currentNode, stateSets, new Node(str), time);
    }
       

    private static void Greedy(String Start_puzzle,Heuristic h) {
        Node StartNode= new Node(Start_puzzle);
        Node currentNode= new Node(Start_puzzle);
        Set<String> visitedNodes= new HashSet<>();
        currentNode.setTotalCost(0);   
    //String current=Start_puzzle;
    int time=0;
    currentNode.startTime=System.nanoTime();
   while (!currentNode.getState().equals(Puzzle8.GOAL_PUZZLE)){
        List<String>child= Node.getSuccessors(currentNode.getState());
        int Minimum=100;
        for(String c:child){
            if(!visitedNodes.contains(c))
            { 
                int min=0;
                if(h==Heuristic.H_ONE)
                    min=heuristicOne(c, Puzzle8.GOAL_PUZZLE);
                else if(h==Heuristic.H_TWO)
                     min=heuristicTwo(c, Puzzle8.GOAL_PUZZLE);
                if(min<Minimum)
                {
                    Node children= new Node(c);
                    children.setParent(currentNode);                  
                    currentNode.addChild(children);
                    children.setTotalCost(min);
                    currentNode=children;
                     Minimum=min;
                }
            }
        }

        visitedNodes.add(currentNode.getState());
        time++;
   }
   Node.printSolution(currentNode, visitedNodes,StartNode , time);
 }
   
    private static Entry<String,Integer> getmin(Map<String,Integer> history){
        Entry<String,Integer> min=null;
        for(Entry<String,Integer> entry:history.entrySet()){
             if (min == null || min.getValue() > entry.getValue()) {
        min = entry;
        }      
    }
     return min;
    }
    //****************************************************************************************************
    // This heuristic estimates the cost to the goal from current state by counting the number of misplaced tiles
    private static int heuristicOne(String currentState, String goalSate) {
        int difference = 0;
        for (int i = 0; i < currentState.length(); i += 1)
            if (currentState.charAt(i) != goalSate.charAt(i))
                difference += 1;
        return difference;
    }

    //*************************************************************************************************
    // This heuristic estimates the cost to the goal from current state by calculating the Manhathan distance from each misplaced
    // tile to its right position in the goal state
    private static int heuristicTwo(String currentState, String goalSate) {
        int difference = 0;
        for (int i = 0; i < currentState.length(); i += 1)
            for (int j = 0; j < goalSate.length(); j += 1)
                if (currentState.charAt(i) == goalSate.charAt(j))
                    difference = difference + ((Math.abs(i % 3 - j % 3)) + Math.abs(i / 3 + j / 3));
        return difference;
    }
    
    
    public static void main(String[] args) {
        // TODO code application logic here
        
        try{
            ReadPuzzel();
            UserChoise();
        }catch(Exception e){
            System.err.println(e);
        }
    }
    
}
